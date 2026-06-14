<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-header />
    <main class="w-full min-h-screen bg-[#F0EFF2]">
        @yield('content')
    </main>
</body>

</html>