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
                <input type="text" id="name" name="name" 
                       placeholder="例: 山田 太郎" 
                       class="form-input" 
                       required>
            </div>
            
            {{-- メールアドレス --}}
            <div class="form-group">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" id="email" name="email" 
                       placeholder="例: test@example.com" 
                       class="form-input" 
                       required>
            </div>
            
            {{-- パスワード --}}
            <div class="form-group">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" id="password" name="password" 
                       placeholder="例: coachtech006" 
                       class="form-input" 
                       required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="register-button">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection