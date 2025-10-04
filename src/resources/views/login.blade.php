@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-page-container">
<h2 class="page-title">Login</h2>

<div class="form-card">
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        
        {{-- メールアドレス --}}
        <div class="form-group">
            <label for="email" class="form-label">メールアドレス</label>
            <input class="form-input" type="email" id="email" name="email"  value="{{ old('email') }}" placeholder="例: test@example.com" required>
        </div>
        
        {{-- パスワード --}}
        <div class="form-group">
            <label for="password" class="form-label">パスワード</label>
            <input class="form-input" type="password" id="password" name="password" placeholder="例: coachtech006" required>
        </div>
        
        
        <div class="form-actions">
            <button type="submit" class="login-button">ログイン</button>
        </div>
    </form>
</div>
@endsection