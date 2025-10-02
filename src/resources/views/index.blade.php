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
                        <input type="text" name="first_name" placeholder="例：山田" value="{{ old('first_name') }}" />
                        <div class="form__error">
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="name-input-set">
                        <input type="text" name="last_name" placeholder="例：太郎" value="{{ old('last_name') }}" />
                        <div class="form__error">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                        </div>
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
                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="1" checked>
                        <label class="form-check-label" for="genderMale">男性</label>
                    </div>
                    {{-- 女性オプション --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="2">
                        <label class="form-check-label" for="genderFemale">女性</label>
                    </div>
                    {{-- その他オプション --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderOther" value="3">
                        <label class="form-check-label" for="genderOther">その他</label>
                    </div>
                </div>
                <div class="form__error">
                    @error('gender')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
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
                    <input type="text" name="phone_part1" maxlength="4" class="phone-input" placeholder="080" value="{{ old('phone_part1') }}" >
                    <span class="hyphen">-</span>
                    {{-- 2つ目の入力欄 (例: 1234) --}}
                    <input type="text" name="phone_part2" maxlength="4" class="phone-input" placeholder="1234" value="{{ old('phone_part2') }}" >
                    <span class="hyphen">-</span>
                    {{-- 3つ目の入力欄 (例: 5678) --}}
                    <input type="text" name="phone_part3" maxlength="4" class="phone-input" placeholder="5678" value="{{ old('phone_part3') }}" >
                </div>
            </div>
            <div class="form_error">
                @if ($errors->has('phone_part1') || $errors->has('phone_part2') || $errors->has('phone_part3'))
                    電話番号の形式が正しくありません。
                @endif
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                <div class="form__error">
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <select name="category_id" class="form-select">
                    <option value="" disabled selected>選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" >{{ $category->content }}</option>
                    @endforeach
                </select>
                <div class="form__error">
                    @error('category_id')
                        {{ $message }}
                    @enderror
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
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください" value="{{ old('detail') }}" ></textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection