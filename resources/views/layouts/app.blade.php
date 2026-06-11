<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestor de Tickets') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Inline: aplica el tema antes de que el CSS renderice, evita flash --}}
    <script>
        (function () {
            var t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')

    <style>
        /* ── sidebar collapsed state ─────────────────── */
        body.sidebar-collapsed #sidebar      { width: 0; overflow: hidden; border-right-width: 0; }
        body.sidebar-collapsed #main-wrapper { margin-left: 0; }

        /* ── Select2 basic overrides ─────────────────── */
        .select2-container .select2-selection--single {
            background: transparent;
            border-radius: 0.75rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 2.5rem; }
        .select2-dropdown { border-radius: 0.75rem; box-shadow: 0 10px 25px rgba(0,0,0,.1); }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 font-sans antialiased flex h-screen overflow-hidden transition-colors duration-200">

    <!-- Sidebar -->
    @include('layouts.partial.sidebar')

    <!-- Mobile overlay — cierra sidebar al hacer clic fuera -->
    <div id="sidebarOverlay"
         class="fixed inset-0 bg-slate-900/40 z-30 hidden md:hidden"
         onclick="closeSidebar()"></div>

    <!-- Main Wrapper -->
    <div id="main-wrapper" class="flex-1 flex flex-col overflow-hidden transition-all duration-300">
        <!-- Topbar -->
        @include('layouts.partial.topbar')

        <!-- Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-slate-950 p-4 md:p-8">
            <div class="max-w-7xl mx-auto">
                @include('layouts.partial.msg')
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        @include('layouts.partial.footer')
    </div>

    <!-- ═══════════════ Profile Modal ═══════════════ -->
    <div id="profileModal"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         style="display:none;"
         role="dialog" aria-modal="true" aria-labelledby="modal-title">

        <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm" onclick="closeProfileModal()"></div>

        <div class="relative w-full max-w-md bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-800">
                <h3 id="modal-title" class="text-lg font-semibold text-slate-900 dark:text-slate-100">Mi Perfil</h3>
                <button onclick="closeProfileModal()"
                        class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="px-6 py-5">
                <form id="profileForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Avatar -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="relative">
                            @if(auth()->user() && auth()->user()->photo)
                                <img id="profilePhotoPreview"
                                     src="{{ Storage::url(auth()->user()->photo) }}?v={{ auth()->user()->updated_at->timestamp }}"
                                     alt="Foto de perfil"
                                     class="w-24 h-24 rounded-full object-cover ring-4 ring-slate-100 dark:ring-slate-800 shadow"
                                     onerror="this.style.display='none'; document.getElementById('profilePhotoPreviewAlt').style.display='flex';">
                                <div id="profilePhotoPreviewAlt"
                                     class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-white items-center justify-center text-3xl font-bold ring-4 ring-slate-100 dark:ring-slate-800 shadow hidden">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                            @else
                                <div id="profilePhotoPreviewAlt"
                                     class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-white flex items-center justify-center text-3xl font-bold ring-4 ring-slate-100 dark:ring-slate-800 shadow">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                            <label for="photoInput"
                                   class="absolute -bottom-1 -right-1 bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded-full shadow-lg cursor-pointer transition-colors">
                                <i class="fas fa-camera text-xs"></i>
                            </label>
                            <input type="file" id="photoInput" name="photo" class="hidden" accept="image/*" onchange="previewProfilePhoto(event)">
                        </div>
                        <p class="mt-3 text-xs text-slate-400 dark:text-slate-500">Clic en la cámara para cambiar la foto</p>
                    </div>

                    <!-- Fields -->
                    <div class="space-y-4">
                        <div>
                            <label for="profileName" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Nombre</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-slate-400 text-sm"></i>
                                </div>
                                <input type="text" name="name" id="profileName"
                                       value="{{ auth()->user()->name ?? '' }}"
                                       class="block w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       required>
                            </div>
                        </div>
                        <div>
                            <label for="profileEmail" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Correo Electrónico</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-slate-400 text-sm"></i>
                                </div>
                                <input type="email" name="email" id="profileEmail"
                                       value="{{ auth()->user()->email ?? '' }}"
                                       class="block w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div id="profileAlert" class="hidden rounded-xl p-3 text-sm mt-4"></div>
                </form>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeProfileModal()"
                        class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Cancelar
                </button>
                <button type="button" id="saveProfileBtn" onclick="saveProfile()"
                        class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition-colors focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i class="fas fa-save mr-1.5"></i>Guardar Cambios
                </button>
            </div>
        </div>
    </div>
    <!-- ══════════════════════════════════════════════ -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts')
    @stack('js')

    <script>
    // ─── Select2 init ──────────────────────────────────────────────────────────
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });
    });

    // ─── Sidebar toggle ────────────────────────────────────────────────────────
    // State: null = default (open en desktop, cerrado en mobile)
    // Persistimos en localStorage para mantener la preferencia entre páginas
    (function initSidebar() {
        var isMobile = window.innerWidth < 768;
        var saved    = localStorage.getItem('sidebarOpen');

        if (isMobile) {
            // En mobile siempre arranca cerrado
            document.body.classList.remove('sidebar-open');
            document.getElementById('sidebar').classList.add('-translate-x-full');
        } else {
            // En desktop, si el usuario lo cerró manualmente, mantenemos cerrado
            if (saved === 'closed') {
                document.body.classList.add('sidebar-collapsed');
            }
        }
    })();

    function toggleSidebar() {
        var isMobile = window.innerWidth < 768;
        var sidebar  = document.getElementById('sidebar');
        var overlay  = document.getElementById('sidebarOverlay');

        if (isMobile) {
            var isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        } else {
            var isCollapsed = document.body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebarOpen', isCollapsed ? 'closed' : 'open');
        }
    }

    function closeSidebar() {
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }

    // ─── User dropdown ─────────────────────────────────────────────────────────
    function toggleUserDropdown() {
        document.getElementById('userDropdown').classList.toggle('hidden');
    }
    window.addEventListener('click', function (e) {
        var btn      = document.getElementById('userMenuBtn');
        var dropdown = document.getElementById('userDropdown');
        if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // ─── Profile modal ─────────────────────────────────────────────────────────
    function openProfileModal() {
        document.getElementById('userDropdown').classList.add('hidden');
        document.getElementById('profileModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeProfileModal() {
        document.getElementById('profileModal').style.display = 'none';
        document.body.style.overflow = '';
        document.getElementById('profileAlert').classList.add('hidden');
    }

    function previewProfilePhoto(event) {
        var input = event.target;
        if (!input.files || !input.files[0]) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            var imgEl  = document.getElementById('profilePhotoPreview');
            var altEl  = document.getElementById('profilePhotoPreviewAlt');
            if (imgEl) {
                imgEl.src = e.target.result;
                imgEl.style.display = '';
                if (altEl) altEl.style.display = 'none';
            } else if (altEl) {
                var img = document.createElement('img');
                img.id        = 'profilePhotoPreview';
                img.src       = e.target.result;
                img.alt       = 'Foto de perfil';
                img.className = 'w-24 h-24 rounded-full object-cover ring-4 ring-slate-100 dark:ring-slate-800 shadow';
                altEl.parentNode.replaceChild(img, altEl);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }

    function saveProfile() {
        var form     = document.getElementById('profileForm');
        var formData = new FormData(form);
        var alertBox = document.getElementById('profileAlert');
        var saveBtn  = document.getElementById('saveProfileBtn');

        saveBtn.disabled    = true;
        saveBtn.innerHTML   = '<i class="fas fa-spinner fa-spin mr-1.5"></i>Guardando...';

        $.ajax({
            url:         '{{ route("profile.update") }}',
            type:        'POST',
            data:        formData,
            processData: false,
            contentType: false,
            headers:     { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                alertBox.className = 'rounded-lg p-3 text-sm mt-4 bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800';
                alertBox.innerHTML = '<i class="fas fa-check-circle me-2"></i> Perfil actualizado correctamente.';
                alertBox.classList.remove('hidden');

                // Actualizar nombre en topbar
                var newName    = document.getElementById('profileName').value.trim();
                var topbarName = document.querySelector('#userMenuBtn span');
                if (topbarName) topbarName.textContent = newName;
                var ddName = document.querySelector('#userDropdown .font-semibold');
                if (ddName) ddName.textContent = newName;

                // Actualizar avatar en topbar
                if (response.photo_url) {
                    var cb       = '?v=' + Date.now();
                    var newSrc   = response.photo_url + cb;
                    var topImg   = document.querySelector('#userMenuBtn img');
                    var topInit  = document.getElementById('topbarInitial');

                    if (topImg) {
                        topImg.src = newSrc;
                    } else {
                        // Crear el img y ocultar la inicial
                        var img       = document.createElement('img');
                        img.src       = newSrc;
                        img.alt       = 'Perfil';
                        img.className = 'w-8 h-8 rounded-full object-cover border border-slate-200 dark:border-slate-700';
                        if (topInit) topInit.parentNode.insertBefore(img, topInit);
                    }
                    if (topInit) topInit.style.display = 'none';

                    // Actualizar preview del modal
                    var modalImg = document.getElementById('profilePhotoPreview');
                    if (modalImg) modalImg.src = newSrc;
                }

                saveBtn.disabled  = false;
                saveBtn.innerHTML = '<i class="fas fa-save mr-1.5"></i>Guardar Cambios';
                setTimeout(closeProfileModal, 1800);
            },

            error: function (xhr) {
                alertBox.className = 'rounded-lg p-3 text-sm mt-4 bg-rose-50 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 border border-rose-200 dark:border-rose-800';
                var msg = 'Error al actualizar el perfil.';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                }
                alertBox.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + msg;
                alertBox.classList.remove('hidden');
                saveBtn.disabled  = false;
                saveBtn.innerHTML = '<i class="fas fa-save mr-1.5"></i>Guardar Cambios';
            }
        });
    }
    </script>
</body>
</html>
