<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact-test</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <h1 class="header__logo">FashionablyLate</h1>
        <nav>
            <ul>
                <li><a href="/">ホーム</a></li>
                <li><a href="/about">概要</a></li>
                {{-- ログインボタンの例 --}}
                @if (Auth::check())
                    {{-- ログインしている場合のボタン（例: ユーザー名表示やログアウトボタン） --}}
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit">logout</button>
                        </form>
                    </li>
                @else
                    {{-- ログインしていない場合のボタン（例: ログイン・新規登録ボタン） --}}
                    <li>
                        <form action="/register" method="get">
                            @csrf
                            <button type="submit">register</button>
                        </form>
                    </li>
                    <li>
                        <form action="/login" method="get">
                            @csrf
                            <button type="submit">login</button>
                        </form>
                    </li>
                @endif
            </ul>
        </nav>

    </header>

    <main class="main">
        @yield('content')
    </main>

    </body>
</html>