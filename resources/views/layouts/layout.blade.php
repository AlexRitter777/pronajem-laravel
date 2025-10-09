
@props([
    'title' => 'PronajemOnline.cz'
])

<!doctype html>
<html
    class="h-full bg-white dark:bg-gray-900"
    :class="{ 'dark': dark }"
    x-data="data"
    lang="cs"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
