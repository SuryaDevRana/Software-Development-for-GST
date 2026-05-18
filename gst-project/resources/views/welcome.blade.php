<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name', 'GST Studio') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased site-shell overflow-x-hidden">
        <div class="relative overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(34,211,238,0.18),transparent_20%),radial-gradient(circle_at_20%_20%,rgba(59,130,246,0.14),transparent_18%),linear-gradient(180deg,rgba(14,29,63,0.95),rgba(5,9,21,0.98))]"></div>
            <header class="relative z-10 max-w-7xl mx-auto px-6 py-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <a href="/" class="inline-flex items-center gap-3 text-white opacity-95 transition hover:opacity-100">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-white/10 ring-1 ring-white/15 text-xl font-semibold">G</span>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">GST Studio</p>
                        <p class="font-semibold text-white">Smart business hub</p>
                    </div>
                </a>
                <nav class="flex flex-wrap items-center gap-3 text-sm">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="theme-button-secondary">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="theme-button-primary">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="theme-button-secondary">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </header>

            <main class="relative z-10 max-w-7xl mx-auto px-6 pb-20">
                <div class="grid gap-12 lg:grid-cols-[1.15fr_0.85fr] items-center">
                    <div class="space-y-8">
                        <div class="theme-tag">
                            <span class="h-2.5 w-2.5 rounded-full bg-cyan-300 animate-pulse mr-3"></span>
                            Launch a GST dashboard that feels premium
                        </div>
                        <div class="space-y-6">
                            <h1 class="theme-heading">Make GST invoicing feel modern and fast.</h1>
                            <p class="theme-subtitle">Build invoices, manage customers, generate tax-ready reports and review your business in one polished dashboard. Designed for speed, clarity and daily use.</p>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                            <a href="{{ route('register') }}" class="theme-button-primary">
                                Start free
                            </a>
                            <a href="#features" class="theme-button-secondary">
                                Explore features
                            </a>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="theme-panel">
                                <p class="text-sm uppercase tracking-[0.24em] text-cyan-200">Fast setup</p>
                                <p class="mt-3 text-sm leading-6 text-slate-300">Create invoices and customers in under a minute.</p>
                            </div>
                            <div class="theme-panel">
                                <p class="text-sm uppercase tracking-[0.24em] text-cyan-200">GST automation</p>
                                <p class="mt-3 text-sm leading-6 text-slate-300">Tax is calculated automatically for every sale.</p>
                            </div>
                            <div class="theme-panel">
                                <p class="text-sm uppercase tracking-[0.24em] text-cyan-200">Live insights</p>
                                <p class="mt-3 text-sm leading-6 text-slate-300">Review revenue, invoices and customer status instantly.</p>
                            </div>
                        </div>
                    </div>

                    <div class="theme-card">
                        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-cyan-400/10 blur-3xl"></div>
                        <div class="absolute -left-16 bottom-0 h-48 w-48 rounded-full bg-blue-500/10 blur-3xl"></div>
                        <div class="relative z-10 space-y-6">
                            <div class="flex items-center justify-between gap-4 rounded-3xl bg-slate-950/90 p-4 ring-1 ring-white/10 shadow-lg">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.32em] text-slate-400">Revenue</p>
                                    <p class="mt-2 text-3xl font-semibold text-white">₹ 4.8L</p>
                                </div>
                                <span class="inline-flex rounded-full bg-cyan-400/10 px-3 py-1 text-xs font-semibold text-cyan-100">+24%</span>
                            </div>
                            <div class="rounded-[1.75rem] bg-slate-950/90 p-5 ring-1 ring-white/10">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-sm text-slate-400">Invoices</p>
                                        <p class="mt-2 text-2xl font-semibold text-white">82</p>
                                    </div>
                                    <div class="rounded-3xl bg-cyan-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-100">Live</div>
                                </div>
                                <div class="mt-4 h-2 rounded-full bg-white/10">
                                    <div class="h-2 rounded-full bg-gradient-to-r from-cyan-400 to-blue-500" style="width:78%"></div>
                                </div>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl bg-slate-950/90 p-4 ring-1 ring-white/10 transition hover:bg-white/5">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Customers</p>
                                    <p class="mt-2 text-xl font-semibold text-white">320+</p>
                                </div>
                                <div class="rounded-3xl bg-slate-950/90 p-4 ring-1 ring-white/10 transition hover:bg-white/5">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Products</p>
                                    <p class="mt-2 text-xl font-semibold text-white">145</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <section id="features" class="relative z-10 max-w-7xl mx-auto px-6 pb-20">
                <div class="theme-grid">
                    <div class="theme-panel">
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-200">Simple accounting</p>
                        <h2 class="mt-4 text-2xl font-semibold text-white">GST-accurate invoices</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-300">Issue e-invoices, GST-ready bills and summary reports without extra effort.</p>
                    </div>
                    <div class="theme-panel">
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-200">Customers</p>
                        <h2 class="mt-4 text-2xl font-semibold text-white">Everything in one place</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-300">Track client history, invoices and payment status with one dashboard.</p>
                    </div>
                    <div class="theme-panel">
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-200">Reports</p>
                        <h2 class="mt-4 text-2xl font-semibold text-white">Insights when you need them</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-300">Review cash flow, invoice totals and GST summaries instantly.</p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
