@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
    <h2>Confirm</h2>
    </div>
    <form class="form" method="POST" action="/thanks">
    @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
            {{-- 1. お名前 (姓と名を結合して表示) --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">お名前</th>
            <td class="confirm-table__text">
            <span class="confirm-value">{{ $contact->last_name . ' ' . $contact->first_name }}</span>
            {{-- 分割されたhiddenフィールドを残す場合は以下のように記述 --}}
            <input type="hidden" name="last_name" value="{{ $contact->last_name }}" />
            <input type="hidden" name="first_name" value="{{ $contact->first_name }}" />
            </td>
            </tr>
            {{-- 2. 性別 --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">性別</th>
            <td class="confirm-table__text">
            <span class="confirm-value">{{ $genderMap[$contact->gender] ?? '未回答' }}</span>
            <input type="hidden" name="gender" value="{{ $contact->gender }}" />
            </td>
            </tr>
            {{-- 3. メールアドレス --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">メールアドレス</th>
            <td class="confirm-table__text">
            <span class="confirm-value">{{ $contact->email }}</span>
            <input type="hidden" name="email" value="{{ $contact->email }}" />
            </td>
            </tr>
            {{-- 4. 電話番号 --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">電話番号</th>
            <td class="confirm-table__text">
            {{-- 電話番号はハイフンで結合して表示 --}}
            <span class="confirm-value">{{ $contact->tel }}</span>
            <input type="hidden" name="tel" value="{{ $contact->tel }}" />
            </td>
            </tr>
            {{-- 5. 住所 --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">住所</th>
            <td class="confirm-table__text">
            <span class="confirm-value">{{ $contact->address }}</span>
            <input type="hidden" name="address" value="{{ $contact->address }}" />
            </td>
            </tr>
            {{-- 6. 建物名 (任意項目) --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">建物名</th>
            <td class="confirm-table__text">
            <span class="confirm-value">{{ $contact->building }}</span>
            <input type="hidden" name="building" value="{{ $contact->building }}" />
            </td>
            </tr>
            {{-- 7. お問い合わせの種類 --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">お問い合わせの種類</th>
            <td class="confirm-table__text">
            {{-- バリューではなく、表示用のテキストを表示 --}}
            <span class="confirm-value">{{ $contact->category->content }}</span>
            <input type="hidden" name="category_id" value="{{ $contact->category_id }}" />
            </td>
            </tr>
            {{-- 8. お問い合わせ内容 --}}
            <tr class="confirm-table__row">
            <th class="confirm-table__header">お問い合わせ内容</th>
            <td class="confirm-table__text">
            {{-- 複数行表示用のクラスを適用 --}}
            <span class="confirm-value-multiline">{{ $contact->detail }}</span>
            <input type="hidden" name="detail" value="{{ $contact->detail }}" />
            </td>
            </tr>
            </table>
        </div>
        <div class="form__button">
            {{-- 送信ボタン: 完了画面へ進む --}}
            <button class="form__button-submit" type="submit">送信</button>
            {{-- 修正ボタン: Contactフォームへ戻る (history.back() を使用) --}}
            <button class="form__button-back" type="button" onclick="history.back()">修正</button>
        </div>
    </form>
</div>
@endsection