@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
<div class="confirm__heading">
<h2>Confirm</h2>
</div>
{{-- フォームは次ページ（完了画面）へデータを渡す役割を持つため、actionを設定するか、ダミーのactionを設定する --}}
<form class="form" method="POST" action="/complete">
@csrf
<div class="confirm-table">
<table class="confirm-table__inner">
{{-- 1. お名前 (姓と名を結合して表示) --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">お名前</th>
<td class="confirm-table__text">
<span class="confirm-value">サンプル姓 サンプル名</span>
{{-- 結合された値（またはhiddenフィールド） --}}
<input type="hidden" name="name" value="サンプル姓 サンプル名" />
{{-- 分割されたhiddenフィールドを残す場合は以下のように記述 --}}
<input type="hidden" name="first_name" value="サンプル姓" />
<input type="hidden" name="last_name" value="サンプル名" />
</td>
</tr>
{{-- 2. 性別 --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">性別</th>
<td class="confirm-table__text">
<span class="confirm-value">男性</span>
<input type="hidden" name="gender" value="male" />
</td>
</tr>
{{-- 3. メールアドレス --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">メールアドレス</th>
<td class="confirm-table__text">
<span class="confirm-value">test@example.com</span>
<input type="hidden" name="email" value="test@example.com" />
</td>
</tr>
{{-- 4. 電話番号 --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">電話番号</th>
<td class="confirm-table__text">
{{-- 電話番号はハイフンで結合して表示 --}}
<span class="confirm-value">090-1234-5678</span>
<input type="hidden" name="tel" value="090-1234-5678" />
</td>
</tr>
{{-- 5. 住所 --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">住所</th>
<td class="confirm-table__text">
<span class="confirm-value">東京都渋谷区千駄ヶ谷1-2-3</span>
<input type="hidden" name="address" value="東京都渋谷区千駄ヶ谷1-2-3" />
</td>
</tr>
{{-- 6. 建物名 (任意項目) --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">建物名</th>
<td class="confirm-table__text">
<span class="confirm-value">千駄ヶ谷マンション101</span>
<input type="hidden" name="building" value="千駄ヶ谷マンション101" />
</td>
</tr>
{{-- 7. お問い合わせの種類 --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">お問い合わせの種類</th>
<td class="confirm-table__text">
{{-- バリューではなく、表示用のテキストを表示 --}}
<span class="confirm-value">商品の問い合わせ</span>
<input type="hidden" name="inquiry_type" value="1" /> {{-- valueはIDを保持する想定 --}}
</td>
</tr>
{{-- 8. お問い合わせ内容 --}}
<tr class="confirm-table__row">
<th class="confirm-table__header">お問い合わせ内容</th>
<td class="confirm-table__text">
{{-- 複数行表示用のクラスを適用 --}}
<span class="confirm-value-multiline">
届いた商品が注文と異なりました。




交換をお願いします。
</span>
<input type="hidden" name="content" value="届いた商品が注文と異なりました。交換をお願いします。" />
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