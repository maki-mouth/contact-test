<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\UserRequest;


class ContactController extends Controller
{
        private const GENDER_MAP = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];


    public function index()
    {
        $categories = Category::all()->unique('content');

        return view('index', compact('categories'));
    }


    public function confirm(ContactRequest $request)
    {
        $contactData = $request->validated();
        Session::put('contact_data', $contactData);

        $contact = new Contact($contactData);

        return view('confirm', [
            'contact' => $contact,
            'genderMap' => self::GENDER_MAP,
        ]);
    }

    public function send()
    {
        $contactData = Session::get('contact_data');

        if (empty($contactData)) {
            return redirect()->route('contact.index');
        }

        Contact::create($contactData);
        Session::forget('contact_data');

        return view('thanks');
    }

    public function admin(Request $request)
    {
        // 1. 基本クエリの開始（N+1問題回避のためCategoryリレーションをEager Load）
        $query = Contact::with('category');

        // 2. 検索・フィルタリング処理の適用
        // 1, 2, 7. 名前(姓/名) または メールアドレス検索 (name="keyword")
        if ($request->filled('keyword')) {
            $keyword = '%' . $request->input('keyword') . '%';
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', $keyword)
                ->orWhere('last_name', 'like', $keyword)
                ->orWhere('email', 'like', $keyword);
            });
        }

        // 3, 8. 性別検索 (name="gender") - 空欄(全て)はスキップ
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // 4. お問い合わせの種類検索 (name="category_id") - 空欄はスキップ
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // 5. 日付検索 (name="date")
        if ($request->filled('date')) {
            // 指定された日付に作成されたデータのみを取得
            $query->whereDate('created_at', $request->input('date'));
        }


        // 3. 並び替えとページネーションの実行
        $contacts = $query
            ->orderBy('created_at', 'desc')
            ->paginate(7)
            ->withQueryString(); // 検索条件を引き継ぐ

        // 4. 共通データの準備
        $categories = Category::all()->unique('content');

        // 5. ビューへのデータ受け渡し
        return view('admin', [
            'contacts' => $contacts,
            'genderMap' => self::GENDER_MAP,
            'categories' => $categories,
            // 検索・フィルタリングの入力値をビューに戻すためにリクエストデータを渡す
            'filters' => $request->all(),
        ]);
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();

        // 削除後に元のページ状態を維持して admin ルートに戻る
        $queryString = request()->headers->get('referer') ? parse_url(request()->headers->get('referer'), PHP_URL_QUERY) : '';
        parse_str($queryString, $queryParams);

        return redirect()->route('admin', $queryParams);
    }
}
