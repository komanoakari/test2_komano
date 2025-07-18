<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <div class="app">
        <header class="header">
            <h2 class="header__heading">mogitate</h2>
            @yield('link')
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
    @yield('js')
</body>
</html>