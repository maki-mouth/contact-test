@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" method="POST" action="/confirm">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="name-field-group">
                     <div class="name-input-set"> 
                        <input type="text" name="first_name" placeholder="例：山田" />
                        <div class="form__error"></div>
                    </div>
                    <div class="name-input-set">
                        <input type="text" name="last_name" placeholder="例：太郎" />
                        <div class="form__error"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="gender-selection">
                    {{-- 男性オプション --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" checked>
                        <label class="form-check-label" for="genderMale">男性</label>
                    </div>

                    {{-- 女性オプション --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                        <label class="form-check-label" for="genderFemale">女性</label>
                    </div>

                    {{-- その他オプション --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other">
                        <label class="form-check-label" for="genderOther">その他</label>
                    </div>
                </div>
                <div class="form__error">
                    </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <input type="email" name="email" placeholder="例：test@example.com" />
                <div class="form__error">
                    </div>
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="input-container">
                    {{-- 1つ目の入力欄 (例: 090) --}}
                    <input 
                        type="text" 
                        name="phone_part1" 
                        maxlength="4" 
                        class="phone-input" 
                        placeholder="080"
                    >

                    <span class="hyphen">-</span>

                    {{-- 2つ目の入力欄 (例: 1234) --}}
                    <input 
                        type="text" 
                        name="phone_part2" 
                        maxlength="4" 
                        class="phone-input" 
                        placeholder="1234"
                    >

                    <span class="hyphen">-</span>

                    {{-- 3つ目の入力欄 (例: 5678) --}}
                    <input 
                        type="text" 
                        name="phone_part3" 
                        maxlength="4" 
                        class="phone-input" 
                        placeholder="5678"
                    >
                </div>
                <div class="form__error">
                    </div>
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" />
                <div class="form__error">
                    </div>
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" />
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <select name="inquiry_type" class="form-select">
                    <option value="" disabled selected>選択してください</option>
                    <option value="1">商品の問い合わせ</option>
                    <option value="2">その他</option>
                </select>
                <div class="form__error">
                    </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください"></textarea>
                </div>
                <div class="form__error">
                    </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection