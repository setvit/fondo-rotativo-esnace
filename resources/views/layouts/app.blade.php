<!DOCTYPE html>
<html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>ESNACE</title>@vite(['resources/css/app.css','resources/js/app.js'])</head>
<body class="font-sans antialiased"><div class="min-h-screen bg-gray-100">
@isset($header)<header class="bg-white shadow"><div class="max-w-7xl mx-auto py-6 px-4">{{ $header }}</div></header>@endisset
<main>@isset($slot){{ $slot }}@else @yield('content')@endisset</main></div></body></html>
