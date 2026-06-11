<aside id="sidebar"
       class="bg-white dark:bg-slate-900 w-64 flex-shrink-0 border-r border-slate-200 dark:border-slate-800
              transition-all duration-300 ease-in-out
              flex flex-col z-40
              fixed md:relative h-full
              -translate-x-full md:translate-x-0">

    {{-- Logo --}}
    <div class="h-16 flex items-center justify-center border-b border-slate-200 dark:border-slate-800 px-6 flex-shrink-0">
        <a href="{{ url('/home') }}" class="flex items-center">
            <img src="{{ asset('backend/dist/img/BCC.png') }}"
                 alt="BCC Logo"
                 class="h-10 w-auto max-w-[160px] object-contain">
        </a>
    </div>

    {{-- Nav --}}
    <div class="flex-1 overflow-y-auto p-4">
        <nav class="space-y-1">

            <p class="px-3 pt-1 pb-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">Principal</p>

            <a href="{{ url('/home') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                      {{ request()->is('home')
                          ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-chart-line w-5 text-center {{ request()->is('home') ? 'text-indigo-500' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span class="text-sm">Panel De Control</span>
            </a>

            <a href="{{ route('tickets.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                      {{ request()->is('tickets*')
                          ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-ticket-alt w-5 text-center {{ request()->is('tickets*') ? 'text-indigo-500' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span class="text-sm">Tickets</span>
            </a>

            <a href="{{ route('clientes.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                      {{ request()->is('clientes*')
                          ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-handshake w-5 text-center {{ request()->is('clientes*') ? 'text-indigo-500' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span class="text-sm">Clientes</span>
            </a>

            <p class="px-3 pt-4 pb-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">Administración</p>

            <a href="{{ route('usuarios.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                      {{ request()->is('usuarios*')
                          ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-users w-5 text-center {{ request()->is('usuarios*') ? 'text-indigo-500' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span class="text-sm">Usuarios</span>
            </a>

            <a href="{{ route('tipousuarios.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                      {{ request()->is('tipousuarios*')
                          ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-user-tag w-5 text-center {{ request()->is('tipousuarios*') ? 'text-indigo-500' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span class="text-sm">Tipos de Usuario</span>
            </a>

            <a href="{{ route('comentarios.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                      {{ request()->is('comentarios*')
                          ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-comments w-5 text-center {{ request()->is('comentarios*') ? 'text-indigo-500' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span class="text-sm">Comentarios</span>
            </a>

        </nav>
    </div>
</aside>
