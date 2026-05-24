<nav class="theme-nav relative z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 overflow-visible">
        <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center py-4 overflow-visible">
            <div class="flex items-center gap-6 overflow-visible">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="theme-brand">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/10 text-cyan-300 text-lg font-bold ring-1 ring-white/10">G</span>
                    <div class="leading-tight">
                        <span class="block text-base font-semibold">GST Studio</span>
                        <span class="block text-xs text-slate-400 tracking-[0.28em] uppercase">Smart billing</span>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-3 overflow-visible">
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('dashboard') }}" class="theme-nav-link {{ request()->routeIs('dashboard') ? 'theme-nav-link-active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>Dashboard
                    </a>
                    <a href="{{ route('customers.index') }}" class="theme-nav-link {{ request()->routeIs('customers.*') ? 'theme-nav-link-active' : '' }} whitespace-nowrap">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>Customers
                    </a>
                    <a href="{{ route('products.index') }}" class="theme-nav-link {{ request()->routeIs('products.*') ? 'theme-nav-link-active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4m0 0L4 7m16 0l-8 4m8-4v10l-8 4m0-10L4 7m0 10l8 4m0 0l8-4m-8 4v-10"></path></svg>Products
                    </a>
                    <a href="/invoices" class="theme-nav-link {{ request()->is('invoices*') ? 'theme-nav-link-active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>Invoices
                    </a>
                </div>

                <button @click="toggle()" class="theme-nav-action shrink-0" aria-label="Toggle theme">
                    <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M17.293 13.293a8 8 0 11-10.586-10.586 8.001 8.001 0 0010.586 10.586z" clip-rule="evenodd" />
                    </svg>
                </button>

            @auth
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="flex items-center gap-3 pl-1 pr-4 py-1.5 rounded-full bg-slate-900/90 text-white text-sm font-semibold hover:bg-slate-800 transition-all focus:outline-none ring-1 ring-white/10" type="button">
                        <div class="h-8 w-8 rounded-full bg-cyan-400/10 flex items-center justify-center text-cyan-300 font-bold text-xs ring-1 ring-cyan-400/20">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                        <svg :class="open ? 'rotate-180' : ''" class="h-4 w-4 opacity-50 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 top-full mt-2 w-56 rounded-2xl border border-slate-700/50 bg-slate-950/95 backdrop-blur-xl shadow-2xl py-2 z-[9999]">
                        <div class="px-4 py-3 border-b border-slate-700/50 mb-1">
                            <p class="text-xs text-slate-400 uppercase tracking-widest font-bold">Account</p>
                            <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:text-white hover:bg-slate-900/50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ __('Profile Settings') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
                @else
                    <a href="{{ route('login') }}" class="theme-nav-link">{{ __('Log in') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="theme-nav-link">{{ __('Register') }}</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
