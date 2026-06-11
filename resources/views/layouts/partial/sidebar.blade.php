<aside id="sidebar" class="bg-white dark:bg-slate-900 w-64 flex-shrink-0 border-r border-slate-200 dark:border-slate-800 transition-transform duration-300 ease-in-out absolute md:relative z-40 h-full -translate-x-full md:translate-x-0">
    <div class="h-16 flex items-center justify-center border-b border-slate-200 dark:border-slate-800 px-4">
        <a href="{{ url('/home') }}" class="flex items-center gap-3">
            <i class="fas fa-ticket-alt text-indigo-600 dark:text-indigo-500 text-2xl"></i>
            <span class="text-lg font-bold text-slate-900 dark:text-white truncate">Gestor de Tickets</span>
        </a>
    </div>
    
    <div class="p-4 overflow-y-auto h-[calc(100%-4rem)]">
        <nav class="space-y-1">
            <a href="{{ url('/home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->is('home') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-chart-line w-5 text-center {{ request()->is('home') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span>Panel De Control</span>
            </a>
            
            <a href="{{ route('tickets.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->is('tickets*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-ticket-alt w-5 text-center {{ request()->is('tickets*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span>Tickets</span>
            </a>

            <a href="{{ route('clientes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->is('clientes*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-handshake w-5 text-center {{ request()->is('clientes*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span>Clientes</span>
            </a>

            <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->is('usuarios*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-users w-5 text-center {{ request()->is('usuarios*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span>Usuarios</span>
            </a>

            <a href="{{ route('tipousuarios.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->is('tipousuarios*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-user-tag w-5 text-center {{ request()->is('tipousuarios*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span>Tipos de Usuario</span>
            </a>

            <a href="{{ route('comentarios.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->is('comentarios*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i class="fas fa-comments w-5 text-center {{ request()->is('comentarios*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}"></i>
                <span>Comentarios</span>
            </a>
        </nav>
    </div>
</aside>