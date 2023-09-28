<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x-jet.banner/>
<div x-data="{ sidebarOpen: false }"    @keydown.window.escape="sidebarOpen=false"
     class="min-h-screen bg-gray-300 print:bg-white ">
    <div class="flex-1">

        <x-menu.top-menu>{{$header}}</x-menu.top-menu>
        <x-menu.side-menu/>

        <!-- Page Content -->
        <main class="p-3 bg-gray-300 print:bg-white ">
            {{ $slot }}
        </main>

        {{--                <x-notify.notification/>--}}
        {{--                <x-notify.flash/>--}}

    </div>
</div>

@stack('modals')

@livewireScripts

<script>
    function copyToClipboard(id) {
        navigator.clipboard.writeText(id);
    }
</script>

@stack('custom-scripts')
</body>
</html>
