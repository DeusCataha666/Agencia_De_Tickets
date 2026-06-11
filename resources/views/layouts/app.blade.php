<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestor de Tickets') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')

    <style>
        /* Small overrides for Select2 and DataTables to match Tailwind */
        .select2-container .select2-selection--single {
            @apply bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 rounded-lg h-10 flex items-center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            @apply text-slate-700 dark:text-slate-300;
        }
        .select2-dropdown {
            @apply bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 rounded-lg shadow-lg;
        }
        .select2-search__field {
            @apply bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded text-slate-700 dark:text-slate-300;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 font-sans antialiased flex h-screen overflow-hidden transition-colors duration-200">

    <!-- Sidebar -->
    @include('layouts.partial.sidebar')

    <!-- Main Wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Topbar -->
        @include('layouts.partial.topbar')

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-slate-950 p-4 md:p-8">
            <div class="max-w-7xl mx-auto">
                @include('layouts.partial.msg')
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        @include('layouts.partial.footer')
    </div>

    <!-- Profile Modal -->
    <div id="profileModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display:none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm" onclick="closeProfileModal()"></div>
        <!-- Panel -->
        <div class="relative w-full max-w-md bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transform transition-all">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-800">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100" id="modal-title">Mi Perfil</h3>
                <button onclick="closeProfileModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                    <i class="fas fa-times text-base"></i>
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
                                <img id="profilePhotoPreview" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Foto de perfil" class="w-24 h-24 rounded-full object-cover ring-4 ring-slate-100 dark:ring-slate-800 shadow">
                            @else
                                <div id="profilePhotoPreviewAlt" class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-white flex items-center justify-center text-3xl font-bold ring-4 ring-slate-100 dark:ring-slate-800 shadow">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                            <label for="photoInput" class="absolute -bottom-1 -right-1 bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded-full shadow-lg cursor-pointer transition-colors">
                                <i class="fas fa-camera text-xs"></i>
                            </label>
                            <input type="file" id="photoInput" name="photo" class="hidden" accept="image/*" onchange="previewProfilePhoto(event)">
                        </div>
                        <p class="mt-3 text-xs text-slate-400 dark:text-slate-500">Haz clic en la cámara para cambiar tu foto</p>
                    </div>
                    <!-- Fields -->
                    <div class="space-y-4">
                        <div>
                            <label for="profileName" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Nombre</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-slate-400 text-sm"></i>
                                </div>
                                <input type="text" name="name" id="profileName" value="{{ auth()->user()->name ?? '' }}" class="block w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" required>
                            </div>
                        </div>
                        <div>
                            <label for="profileEmail" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Correo Electrónico</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-slate-400 text-sm"></i>
                                </div>
                                <input type="email" name="email" id="profileEmail" value="{{ auth()->user()->email ?? '' }}" class="block w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" required>
                            </div>
                        </div>
                    </div>
                    <!-- Alert -->
                    <div id="profileAlert" class="hidden rounded-xl p-3 text-sm mt-4"></div>
                </form>
            </div>
            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeProfileModal()" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Cancelar
                </button>
                <button type="button" onclick="saveProfile()" class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition-colors focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i class="fas fa-save mr-1.5"></i>Guardar Cambios
                </button>
            </div>
        </div>
    </div>

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
        // Inicializar Select2
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });
        });

        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Dropdown User Toggle
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const btn = document.getElementById('userMenuBtn');
            const dropdown = document.getElementById('userDropdown');
            if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Profile Modal Logic
        function openProfileModal() {
            document.getElementById('userDropdown').classList.add('hidden');
            const modal = document.getElementById('profileModal');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeProfileModal() {
            const modal = document.getElementById('profileModal');
            modal.style.display = 'none';
            document.body.style.overflow = '';
            document.getElementById('profileAlert').classList.add('hidden');
        }

        function previewProfilePhoto(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreview = document.getElementById('profilePhotoPreview');
                    const altPreview = document.getElementById('profilePhotoPreviewAlt');
                    
                    if (imgPreview) {
                        imgPreview.src = e.target.result;
                    } else if (altPreview) {
                        // Create img element to replace alt
                        const img = document.createElement('img');
                        img.id = 'profilePhotoPreview';
                        img.src = e.target.result;
                        img.alt = 'Foto de perfil';
                        img.className = 'w-24 h-24 rounded-full object-cover ring-4 ring-slate-100 shadow';
                        altPreview.parentNode.replaceChild(img, altPreview);
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function saveProfile() {
            const form = document.getElementById('profileForm');
            const formData = new FormData(form);
            const alertBox = document.getElementById('profileAlert');

            // If uploading photo, we need POST with method spoofing
            // The form already has @method('PUT') so _method is already in formData.
            // When sending files via AJAX to a PUT route in Laravel, you must send as POST 
            // and let the _method=PUT spoof it.
            const url = '{{ route("profile.update") }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alertBox.className = 'rounded-lg p-3 text-sm mb-4 bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800';
                    alertBox.innerHTML = '<i class="fas fa-check-circle me-2"></i> Perfil actualizado correctamente.';
                    alertBox.classList.remove('hidden');
                    
                    // Reload page after 1.5s to reflect changes
                    setTimeout(() => window.location.reload(), 1500);
                },
                error: function(xhr) {
                    alertBox.className = 'rounded-lg p-3 text-sm mb-4 bg-rose-50 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400 border border-rose-200 dark:border-rose-800';
                    let errorMsg = 'Error al actualizar perfil.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    alertBox.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i> ' + errorMsg;
                    alertBox.classList.remove('hidden');
                }
            });
        }
    </script>
</body>
</html>
