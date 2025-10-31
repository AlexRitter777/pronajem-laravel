
@props([
    'title' => 'Vyúčtováno!'
])

<!doctype html>
<html
    class="h-full bg-white dark:bg-gray-900"
{{--    :class="{ 'dark': dark }"--}}
{{--    x-data="data"--}}
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

<!-- Sidebar for mobile devices -->
<x-sidebar.sidebar-mobile-wrapper/>

<!-- Static sidebar for desktop -->
<x-sidebar.sidebar-desktop/>

<div class="lg:pl-72">

    <x-partials.header/>

    <main class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if( auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                    && ! auth()->user()->hasVerifiedEmail()
                    && !request()->routeIs('profile.edit')
                )
            <x-alerts.simple-warning>
                {{__('Your email address isn’t verified yet. Some features may be unavailable until you verify it.')}}
                <a href="{{ route('profile.edit') }}" class="font-medium text-yellow-700 underline hover:text-yellow-600 dark:text-yellow-300 dark:hover:text-yellow-200">
                    {{ __('Verify email') }}.
                </a>
            </x-alerts.simple-warning>
            @endif
            <x-alerts.alerts-kit/>
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
