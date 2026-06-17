<header class="h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 z-30 transition-colors duration-200">
    <div class="flex items-center gap-3">
        {{-- Toggle sidebar: siempre visible en todas las resoluciones --}}
        <button id="sidebarToggleBtn" onclick="toggleSidebar()" title="Ocultar/mostrar menú"
                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
            <i id="sidebarIcon" class="fas fa-bars text-base"></i>
        </button>
    </div>

    <div class="flex items-center gap-2 md:gap-3">
        <!-- User Dropdown -->
        @auth
        <div class="relative">
            <button id="userMenuBtn" onclick="toggleUserDropdown()"
                    class="flex items-center gap-2 focus:outline-none hover:bg-slate-50 dark:hover:bg-slate-800 p-1 pr-2 rounded-xl transition-colors">
                {{-- Avatar --}}
                @if(auth()->user()->photo)
                    <img src="{{ route('profile.photo') }}?v={{ auth()->user()->updated_at->timestamp }}"
                         alt="Perfil"
                         class="w-8 h-8 rounded-full object-cover border border-slate-200 dark:border-slate-700"
                         onerror="this.style.display='none'; document.getElementById('topbarInitial').style.display='flex';">
                    <div id="topbarInitial"
                         class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 items-center justify-center font-bold text-sm border border-indigo-200 dark:border-indigo-800 hidden">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                @else
                    <div id="topbarInitial"
                         class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm border border-indigo-200 dark:border-indigo-800">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                @endif

                <span class="hidden md:block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ auth()->user()->name }}
                </span>
                <i class="fas fa-chevron-down text-xs text-slate-400 hidden md:block"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="userDropdown"
                 class="hidden absolute right-0 mt-2 w-52 bg-white dark:bg-slate-900 rounded-xl shadow-lg border border-slate-200 dark:border-slate-800 py-1 z-50 overflow-hidden origin-top-right">
                <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">{{ auth()->user()->email }}</p>
                </div>

                <button onclick="openProfileModal()"
                        class="w-full text-left px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors flex items-center gap-2.5">
                    <i class="fas fa-user-circle text-slate-400 w-4 text-center"></i> Mi Perfil
                </button>

                <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="w-full text-left px-4 py-2.5 text-sm text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors flex items-center gap-2.5">
                    <i class="fas fa-sign-out-alt w-4 text-center"></i> Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
        @endauth
    </div>
</header>
