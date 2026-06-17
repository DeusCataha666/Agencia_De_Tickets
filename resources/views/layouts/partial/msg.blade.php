@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="mb-4 bg-rose-50 dark:bg-rose-900/20 border-l-4 border-rose-500 rounded-r-xl p-4 flex justify-between items-start">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-rose-500 dark:text-rose-400 text-lg mt-0.5"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-rose-800 dark:text-rose-300">Hubo un problema</h3>
                    <div class="mt-1 text-sm text-rose-700 dark:text-rose-400">
                        <p>{{ $error }}</p>
                    </div>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.style.display='none'" class="text-rose-500 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 focus:outline-none transition-colors">
                <span class="sr-only">Cerrar</span>
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
    @endforeach
@endif

@if(session('successMsg'))
    <div class="mb-4 bg-emerald-50 dark:bg-emerald-900/20 border-l-4 border-emerald-500 rounded-r-xl p-4 flex justify-between items-start">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-emerald-500 dark:text-emerald-400 text-lg mt-0.5"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-emerald-800 dark:text-emerald-300">¡Éxito!</h3>
                <div class="mt-1 text-sm text-emerald-700 dark:text-emerald-400">
                    <p>{{ session('successMsg') }}</p>
                </div>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.style.display='none'" class="text-emerald-500 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 focus:outline-none transition-colors">
            <span class="sr-only">Cerrar</span>
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
@endif