<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        @guest
            <a href="{{ route('login') }}"> войти в аккаунт</a>
            <a href="{{ route('register') }}">зарегистрироваться</a>
        @endguest
        @auth
            <a href="{{ route('dashboard') }}">личный кабинет</a>
            <a href="{{route('generateToken')}}"> получить api токен</a>
        @endauth
    </header>
    @yield('content')
</body>

</html>
