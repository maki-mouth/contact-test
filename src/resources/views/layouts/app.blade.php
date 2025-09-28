<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact-test</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    
    {{-- 共通ヘッダー: LogoとLoginボタン --}}
    <header class="common-header">
        <div class="header-content">
            <h1 class="logo">FashionablyLate</h1>
            
            {{-- loginボタン --}}
            <a href="/login" class="login-button">login</a>
        </div>
    </header>

    {{-- 各ページ固有のコンテンツがここに挿入されます --}}
    <main>
        @yield('content')
    </main>

</body>
</html>