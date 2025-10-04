@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-page-container">
<h2 class="page-title">Register</h2>

<div class="form-card">
    <form class="register-form" method="POST" action="/register">
        @csrf
        
        {{-- お名前 --}}
        <div class="form-group">
            <label for="name" class="form-label">お名前</label>
            <input class="form-input" type="text" id="name" name="name"  value="{{ old('name') }}" placeholder="例: 山田 太郎" >
            <div class="form__error
            ">
            @error('name')
                {{ $message }}
            @enderror
            </div>
        </div>
        
        {{-- メールアドレス --}}
        <div class="form-group">
            <label for="email" class="form-label">メールアドレス</label>
            <input class="form-input" type="email" id="email" name="email"  value="{{ old('email') }}" placeholder="例: test@example.com" >
            <div class="form__error
            ">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        
        {{-- パスワード --}}
        <div class="form-group">
            <label for="password" class="form-label">パスワード</label>
            <input class="form-input" type="password" id="password" name="password" placeholder="例: coachtech006" >
            <div class="form__error
            ">
            @error('password')
                {{ $message }}
            @enderror
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="register-button">登録</button>
        </div>
    </form>
</div>
@endsection