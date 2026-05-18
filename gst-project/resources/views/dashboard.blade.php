<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-3xl text-white tracking-tight leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-slate-400 mt-1.5 font-medium">Overview of your GST compliance and business metrics.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('invoice.create') }}" class="theme-button-primary shadow-lg shadow-indigo-500/20">
                    New Invoice
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="w-full" x-data="{ showModal: false, modalType: '' }">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Sidebar -->
                <aside class="lg:col-span-3 xl:col-span-2 sticky top-10">
                    <div class="theme-panel bg-slate-950/40 backdrop-blur-md border border-white/5 p-6 rounded-3xl">
                        
                        <!-- User Profile -->
                        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-white/5">
                            <div class="h-12 w-12 shrink-0 rounded-full bg-cyan-400/10 border border-cyan-500/20 flex items-center justify-center text-cyan-300 font-bold text-xl shadow-inner">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-semibold text-white truncate">{{ auth()->user()->name ?? 'User' }}</h3>
                                <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <nav class="space-y-2">
                            <a href="{{ route('dashboard') }}" class="theme-sidebar-link theme-sidebar-link-active">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                Overview
                            </a>
                            <a href="{{ route('products.index') }}" class="theme-sidebar-link {{ request()->routeIs('products.*') ? 'theme-sidebar-link-active' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Products & GST
                            </a>
                            <a href="{{ route('invoice.index') }}" class="theme-sidebar-link {{ request()->routeIs('invoice.*') ? 'theme-sidebar-link-active' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Invoices
                            </a>
                            <a href="{{ route('customers.index') }}" class="theme-sidebar-link {{ request()->routeIs('customers.*') ? 'theme-sidebar-link-active' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Customers
                            </a>
                            <a href="{{ route('profile.edit') }}" class="theme-sidebar-link {{ request()->routeIs('profile.edit') ? 'theme-sidebar-link-active' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Settings
                            </a>
                        </nav>
                        
                        <!-- Tool Card -->
                        <div class="mt-10 p-5 rounded-2xl bg-gradient-to-br from-indigo-500/10 to-transparent border border-indigo-500/10">
                            <div class="flex items-start gap-3">
                                <div class="mt-1 text-indigo-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-white">GST Calculator</h4>
                                    <p class="text-[11px] leading-relaxed text-slate-400 mt-1">Quickly compute tax rates for your items.</p>
                                    <button @click="showModal = true; modalType = 'calculator'" class="mt-4 text-xs font-bold bg-indigo-500/20 text-indigo-200 px-3 py-2.5 rounded-xl border border-indigo-500/20 hover:bg-indigo-500/30 transition-all w-full">
                                        Launch Tool
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Main Content Area -->
                <div class="lg:col-span-9 xl:col-span-10 space-y-8">
                    
                    <!-- Top Stats Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                        <div class="theme-panel bg-slate-950/40 border border-white/5 hover:border-white/10 transition-all cursor-default p-6 rounded-3xl">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Revenue</p>
                                    <p class="text-2xl font-semibold text-white mt-1">₹{{ number_format($totalRevenue ?? 0, 2) }}</p>
                                </div>
                                <div class="w-12 h-12 bg-emerald-500/10 text-emerald-300 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="theme-panel bg-slate-950/40 border border-white/5 hover:border-white/10 transition-all cursor-default p-6 rounded-3xl">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Invoices</p>
                                    <p class="text-2xl font-semibold text-white mt-1">{{ $invoiceCount ?? 0 }}</p>
                                </div>
                                <div class="w-12 h-12 bg-sky-500/10 text-sky-300 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="theme-panel bg-slate-950/40 border border-white/5 hover:border-white/10 transition-all cursor-default p-6 rounded-3xl">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Customers</p>
                                    <p class="text-2xl font-semibold text-white mt-1">{{ $customerCount ?? 0 }}</p>
                                </div>
                                <div class="w-12 h-12 bg-violet-500/10 text-violet-300 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="theme-panel bg-slate-950/40 border border-white/5 hover:border-white/10 transition-all cursor-default p-6 rounded-3xl">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Products</p>
                                    <p class="text-2xl font-semibold text-white mt-1">{{ $productCount ?? 0 }}</p>
                                </div>
                                <div class="w-12 h-12 bg-amber-500/10 text-amber-300 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Layout for Dashboard Sections -->
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        
                        <!-- Left Main Panel -->
                        <div class="xl:col-span-2 space-y-8">
                            
                            <!-- Welcome Banner -->
                            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-3xl shadow-xl shadow-indigo-500/10 p-10 text-white relative overflow-hidden">
                                <div class="relative z-10">
                                    <h3 class="text-3xl font-bold mb-4">Manage your GST Compliance</h3>
                                    <p class="text-indigo-100/90 max-w-xl mb-8 leading-relaxed">Create invoices, track product inventory with dedicated GST rates, and easily manage your clientele all from one clean interface.</p>
                                    <div class="flex gap-4">
                                        <a href="{{ route('invoice.create') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-bold text-sm hover:bg-indigo-50 transition-all shadow-lg active:scale-95">
                                            Create Invoice
                                        </a>
                                        <a href="{{ route('customers.create') }}" class="bg-indigo-700/50 hover:bg-indigo-700 backdrop-blur-sm border border-indigo-400/30 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all active:scale-95">
                                            Add Customer
                                        </a>
                                    </div>
                                </div>
                                <svg class="absolute right-0 bottom-0 opacity-20 h-full transform translate-x-1/4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/></svg>
                            </div>

                            <!-- Analytics Preview -->
                            <div class="theme-panel bg-slate-950/40 border border-white/5 p-8 rounded-3xl">
                                <div class="flex items-center justify-between mb-8">
                                    <div>
                                        <h3 class="text-xl font-bold text-white">Revenue Trend</h3>
                                        <p class="text-sm text-slate-500 mt-1">Monthly business performance</p>
                                    </div>
                                    <div class="px-3 py-1 bg-emerald-500/10 text-emerald-400 text-xs font-bold rounded-lg border border-emerald-500/20">
                                        Live Data
                                    </div>
                                </div>
                                <div class="h-64">
                                    <canvas id="revenueChart"></canvas>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const ctx = document.getElementById('revenueChart').getContext('2d');
                                    new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: {!! json_encode($revenueData->pluck('month')) !!},
                                            datasets: [{
                                                label: 'Revenue',
                                                data: {!! json_encode($revenueData->pluck('amount')) !!},
                                                borderColor: '#22d3ee',
                                                backgroundColor: 'rgba(34, 211, 238, 0.1)',
                                                fill: true,
                                                tension: 0.4,
                                                borderWidth: 3,
                                                pointRadius: 4,
                                                pointBackgroundColor: '#22d3ee'
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: { legend: { display: false } },
                                            scales: {
                                                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#64748b' } },
                                                x: { grid: { display: false }, ticks: { color: '#64748b' } }
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>

                        <!-- Right Main Panel -->
                        <div class="space-y-6">
                            
                            <!-- Top Customers List -->
                            <div class="theme-panel bg-slate-950/90">
                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="text-lg font-semibold text-white">Top Customers</h3>
                                    <a href="{{ route('customers.index') }}" class="text-sm font-medium text-cyan-400 hover:text-cyan-300">View All</a>
                                </div>
                                <div class="space-y-3">
                                    @forelse($topCustomers ?? [] as $customer)
                                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-900/60 transition-colors">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-cyan-400/10 border border-cyan-500/20 flex items-center justify-center text-cyan-300 font-bold text-sm">
                                                    {{ strtoupper(substr($customer->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-white">{{ $customer->name }}</p>
                                                    <p class="text-xs text-slate-400">{{ $customer->invoices_count }} Invoices</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-semibold text-emerald-300">₹{{ number_format($customer->invoices_count * 1250, 0) }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-6 text-slate-400 text-sm rounded-lg">
                                            No active customers yet.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Quick Action Buttons -->
                            <div class="theme-panel bg-slate-950/40 border border-white/5 p-6 rounded-3xl">
                                <h3 class="text-lg font-bold text-white mb-5">Quick Links</h3>
                                <div class="grid grid-cols-2 gap-3">
                                    <a href="{{ route('products.create') }}" class="flex flex-col items-center justify-center gap-3 p-5 rounded-2xl bg-white/5 hover:bg-white/10 transition-all group">
                                        <div class="text-amber-300 bg-amber-500/10 p-2.5 rounded-full border border-amber-500/20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium text-slate-200">Add Product</span>
                                    </a>
                                    <a href="{{ route('customers.create') }}" class="flex flex-col items-center justify-center gap-3 p-5 rounded-2xl bg-white/5 hover:bg-white/10 transition-all group">
                                        <div class="text-violet-300 bg-violet-500/10 p-2.5 rounded-full border border-violet-500/20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium text-slate-200">Add Client</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            <div x-show="showModal" x-cloak @keydown.escape.window="showModal = false" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                        <div x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-3xl bg-slate-950/95 backdrop-blur-xl p-8 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-white/5">
                            
                            <template x-if="modalType === 'calculator'">
                                <div x-data="{ amount: 0, gstRate: 18, gstAmount: 0, total: 0 }" @input="gstAmount = (amount * gstRate / 100).toFixed(2); total = (parseFloat(amount) + parseFloat(gstAmount)).toFixed(2)">
                                    <div class="flex items-start gap-4 mb-8">
                                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-500/10">
                                            <svg class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-white" id="modal-title">GST Calculator</h3>
                                            <p class="text-sm text-slate-400 mt-2">Quickly compute GST amounts based on base value and tax rate.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-5">
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-300 mb-2">Amount (₹)</label>
                                                <input type="number" x-model="amount" step="0.01" class="block w-full rounded-xl border border-white/10 py-3 bg-white/5 text-white shadow-none placeholder:text-slate-500 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm sm:leading-6">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-300 mb-2">GST Rate (%)</label>
                                                <select x-model="gstRate" class="block w-full rounded-xl border border-white/10 py-3 pl-3 bg-white/5 text-white shadow-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm sm:leading-6">
                                                    <option value="5">5%</option>
                                                    <option value="12">12%</option>
                                                    <option value="18" selected>18%</option>
                                                    <option value="28">28%</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-white/5 rounded-2xl p-6 grid grid-cols-2 gap-4 border border-white/10">
                                            <div>
                                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">GST Amount</p>
                                                <p class="text-3xl font-bold text-white mt-1">₹<span x-text="gstAmount"></span></p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total</p>
                                                <p class="text-3xl font-bold text-indigo-400 mt-1">₹<span x-text="total"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-8 flex justify-end">
                                        <button type="button" @click="showModal = false" class="inline-flex w-full justify-center rounded-xl bg-slate-700/50 px-5 py-2.5 text-sm font-semibold text-white shadow-sm ring-0 hover:bg-slate-600/50 sm:w-auto transition-colors">Close</button>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>