{{--
    Component: sidebar
    Usage: <x-sidebar.sidebar />
    Props: none (this component renders the application sidebar and its links).
    Notes:
        - The component expects parent layout to provide Alpine state `sidebarOpen`.
--}}
<!-- Sidebar -->
<div class="fixed inset-y-0 left-0 z-40 bg-white dark:bg-slate-900 shadow-xl border-r border-slate-200 dark:border-slate-800 transition-all duration-300 transform" 
     :class="sidebarOpen ? 'w-64 translate-x-0' : 'w-64 -translate-x-full lg:w-20 lg:translate-x-0'" 
     style="margin-top: 73px; height: calc(100vh - 73px);">
    <!-- Sidebar Content -->
    <div class="h-full overflow-y-auto">
        <div class="p-6 space-y-2" :class="!sidebarOpen && 'lg:px-3'">
            <nav class="space-y-1">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <x-sidebar.sidebar-link href="{{ route('admin.dashboard') }}" label="Beranda" :active="request()->routeIs('admin.dashboard')">
                            <x-slot:icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </x-slot:icon>
                        </x-sidebar.sidebar-link>

                        <x-sidebar.sidebar-link href="{{ route('users.index') }}" label="Pengguna" :active="request()->routeIs('users.*')">
                            <x-slot:icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <!-- Primary user -->
                                    <circle cx="9" cy="7" r="3" />
                                    <path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2" />
                                    <!-- Secondary user (behind/right) -->
                                    <path d="M16 3.13a4 4 0 010 7.75" />
                                    <path d="M21 21v-2a4 4 0 00-3-3.87" />
                                </svg>
                            </x-slot:icon>
                        </x-sidebar.sidebar-link>
                        
                        <x-sidebar.sidebar-link href="{{ route('examples.index') }}" label="Contoh Menu" :active="request()->routeIs('examples.*')">
                            <x-slot:icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </x-slot:icon>
                        </x-sidebar.sidebar-link>

                        <x-sidebar.sidebar-link href="{{ route('exams.index') }}" label="Subtes" :active="request()->routeIs('exams.*')">
                            <x-slot:icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </x-slot:icon>
                        </x-sidebar.sidebar-link>

                        <x-sidebar.sidebar-link href="{{ route('programs.index') }}" label="Program Studi" :active="request()->routeIs('programs.*')">
                            <x-slot:icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                            </x-slot:icon>
                        </x-sidebar.sidebar-link>

                    @elseif (auth()->user()->role === 'user')
                        <x-sidebar.sidebar-link href="{{ route('user.dashboard') }}" label="Beranda" :active="request()->routeIs('user.dashboard')">
                            <x-slot:icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </x-slot:icon>
                        </x-sidebar.sidebar-link>
                    @endif
                @endauth
            </nav>
        </div>
    </div>
</div>