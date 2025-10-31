@props([
    'title' => 'Vyúčtováno!'
])

<!doctype html>
<html
    class="h-full bg-gray-50 dark:bg-gray-900"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    <title>{{ $title }}</title>
    <script>
        if (
            localStorage.getItem('dark') === 'true' ||
            (!localStorage.getItem('dark') && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">

<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img src="{{ asset('img/logo/logo_transparent.png') }}" alt="Vyuctovano" class="mx-auto h-15 w-auto dark:hidden" />
        <img src="{{ asset('img/logo/logo_transparent.png') }}" alt="Vyuctovano" class="mx-auto h-15 w-auto not-dark:hidden" />
        <h2 class="mt-3 text-center text-3xl font-bold tracking-normal text-indigo-900 dark:text-white">Vyúčtováno!</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div class="bg-white px-6 py-12 shadow-sm sm:rounded-lg sm:px-12 dark:bg-gray-800/50 dark:shadow-none dark:outline dark:-outline-offset-1 dark:outline-white/10">
            <x-alerts.alerts-kit/>
            <x-auth.auth-session-status class="mb-4 flex justify-center" :status="session('status')" />
            {{ $slot }}
        </div>

    </div>
</div>

</body>
</html>



