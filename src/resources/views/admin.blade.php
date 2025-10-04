@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="admin-title">Admin</h2>

        <form action="{{ route('admin') }}" method="GET" class="filter-form">
        <div class="filter-area">
            {{-- 1, 2. 名前・メールアドレス検索 (name="keyword"に変更) --}}
            <input type="text" 
                name="keyword"
                placeholder="名前やメールアドレスを入力してください" 
                class="text-input input-name-email"
                value="{{ $filters['keyword'] ?? '' }}">

            {{-- 3, 8. 性別検索 (name="gender") --}}
            <select name="gender" class="dropdown-input input-gender">
                {{-- デフォルトで表示し、値がない場合は選択される。--}}
                <option value="" disabled @if(empty($filters['gender'])) selected @endif>性別</option>
                {{-- 「全て」の選択肢を追加。値は空文字列で、フィルタリングを無効化する。 --}}
                <option value="">全て</option> 
                @foreach($genderMap as $code => $label)
                    <option value="{{ $code }}" @if(isset($filters['gender']) && (string)$filters['gender'] === (string)$code) selected @endif>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            {{-- 4. お問い合わせの種類検索 (name="category_id") --}}
            <select name="category_id" class="dropdown-input input-category_id">
                {{-- 【修正ポイント】value="" かつ disabled を追加し、プレースホルダーとして機能させる --}}
                <option value="" disabled @if(empty($filters['category_id'])) selected @endif>お問い合わせの種類</option>
                {{-- 「全て」の機能を持つ、値が空のオプション（検索条件クリア用）--}}
                <option value="">全て</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(isset($filters['category_id']) && (string)$filters['category_id'] === (string)$category->id) selected @endif>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            {{-- 5. 日付検索 (name="date") --}}
            <input type="text" 
                name="date"
                placeholder="年/月/日" 
                onfocus="(this.type='date')" 
                onblur="if(!this.value) this.type='text'" 
                class="dropdown-input input-date"
                value="{{ $filters['date'] ?? '' }}">
                
            {{-- 6. 検索ボタン --}}
            <button type="submit" class="search-button">検索</button>

            {{-- リセットボタン: 全てのクエリパラメータをクリアして admin 画面に戻る --}}
            <a href="{{ route('admin') }}" class="reset-button">リセット</a>
        </div>
    </form>
        <div class="data-area">
            <div class="data-area-header">
                <button class="export-button">エクスポート</button>
                {{ $contacts->links() }}
            </div>

            <table class="contact-table">
                <thead>
                    <tr class="table-header">
                        <th class="col-name">お名前</th>
                        <th class="col-gender">性別</th>
                        <th class="col-email">メールアドレス</th>
                        <th class="col-type">お問い合わせの種類</th>
                        <th class="col-detail"></th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr class="table-row">
                        <td class="col-name">{{ $contact->last_name . '  ' . $contact->first_name }}</td>
                        <td class="col-gender">{{ $genderMap[$contact->gender] ?? '未回答' }}</td>
                        <td class="col-email">{{ $contact->email }}</td>
                        <td class="col-type">{{ $contact->category->content }}</td>
                        <td class="col-detail">
                            {{-- 変更点1: ボタンをモーダルIDへのリンク（<a>タグ）に変更 --}}
                            <a href="#modal-{{ $contact->id }}" class="detail-button">詳細</a>
                        </td>
                    </tr>

                    {{-- 変更点2: モーダル本体をループ内で定義 --}}
                    {{-- ID: #modal-{contact_id} が詳細ボタンのリンクと対応する --}}
                    <div id="modal-{{ $contact->id }}" class="modal">
                        <div class="modal-content">
                            {{-- 閉じるボタン: #close へのリンクで :target を解除し、モーダルを非表示にする --}}
                            <a href="#" class="modal-close">&times;</a>
                            
                            
                            <div class="modal-details">
                                {{-- 各項目を row クラスで囲み、項目名と値を separated-label/value で区切る --}}
                                <div class="modal-row">
                                    <span class="label">お名前</span>
                                    <span class="value">{{ $contact->last_name }} {{ $contact->first_name }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">性別</span>
                                    <span class="value">{{ $genderMap[$contact->gender] ?? '未回答' }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">メールアドレス</span>
                                    <span class="value">{{ $contact->email }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">電話番号</span>
                                    <span class="value">{{ $contact->tel }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">住所</span>
                                    <span class="value">{{ $contact->address }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">建物名</span>
                                    <span class="value">{{ $contact->building }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">お問い合わせの種類</span>
                                    <span class="value">{{ $contact->category->content }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">お問い合わせ内容</span>
                                    <span class="value">{{ $contact->detail }}</span>
                                </div>
                            </div>

                            <form class="delete-form" action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">削除</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
