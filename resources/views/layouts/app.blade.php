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
    <div id="profileModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/75 transition-opacity" aria-hidden="true" onclick="closeProfileModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-800">
                <div class="bg-white dark:bg-slate-900 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-semibold text-slate-900 dark:text-slate-100" id="modal-title">Mi Perfil</h3>
                            <div class="mt-4">
                                <form id="profileForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-col items-center mb-6">
                                        <div class="relative group">
                                            @if(auth()->user() && auth()->user()->photo)
                                                <img id="profilePhotoPreview" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Foto de perfil" class="w-24 h-24 rounded-full object-cover border-4 border-slate-100 dark:border-slate-800 shadow-sm">
                                            @else
                                                <div id="profilePhotoPreviewAlt" class="w-24 h-24 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-3xl font-bold border-4 border-slate-100 dark:border-slate-800 shadow-sm">
                                                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                                                </div>
                                            @endif
                                            <label for="photoInput" class="absolute bottom-0 right-0 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 p-2 rounded-full shadow-md border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                            <input type="file" id="photoInput" name="photo" class="hidden" accept="image/*" onchange="previewProfilePhoto(event)">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="profileName" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nombre</label>
                                        <input type="text" name="name" id="profileName" value="{{ auth()->user()->name ?? '' }}" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm px-4 py-2" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="profileEmail" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Correo Electrónico</label>
                                        <input type="email" name="email" id="profileEmail" value="{{ auth()->user()->email ?? '' }}" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm px-4 py-2" required>
                                    </div>
                                    <div id="profileAlert" class="hidden rounded-lg p-3 text-sm mb-4"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-slate-800">
                    <button type="button" onclick="saveProfile()" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Guardar Cambios
                    </button>
                    <button type="button" onclick="closeProfileModal()" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Cancelar
                    </button>
                </div>
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
            document.getElementById('profileModal').classList.remove('hidden');
        }

        function closeProfileModal() {
            document.getElementById('profileModal').classList.add('hidden');
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
                        img.className = 'w-24 h-24 rounded-full object-cover border-4 border-slate-100 dark:border-slate-800 shadow-sm';
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

            // Determine if we're uploading a photo or just updating text
            const hasPhoto = document.getElementById('photoInput').files.length > 0;
            const url = hasPhoto ? '{{ route("profile.photo") }}' : '{{ route("profile.update") }}';
            
            if (hasPhoto) {
                // If uploading photo, we need POST with method spoofing
                formData.set('_method', 'POST'); 
            }

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
