<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeToggle()" :class="{'dark': darkMode}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <style>[x-cloak] { display: none !important; }</style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Initialize theme immediately to prevent white flash before Alpine loads
            (function() {
                let isDark = false;
                try {
                    const savedTheme = localStorage.getItem('darkMode');
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    isDark = savedTheme === 'true' || (savedTheme === null && prefersDark);
                } catch (e) { isDark = false; }

                if (isDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();

            function themeToggle() {
                return {
                    darkMode: document.documentElement.classList.contains('dark'),
                    toggle() {
                        this.darkMode = !this.darkMode;
                        try {
                            localStorage.setItem('darkMode', this.darkMode);
                        } catch (e) {}
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans antialiased site-shell">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-slate-950/90 backdrop-blur-sm">
                    <div class="max-w-8xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-10">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
