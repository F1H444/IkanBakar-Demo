<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - {{ config('app.name', 'Ikan Bakar Nusantara') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <a href="/" class="text-2xl font-bold text-orange-500">IkanBakar <span
                        class="text-sm font-normal text-gray-400">User</span></a>
            </div>
            <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-orange-600' : 'hover:bg-gray-800' }} transition">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('user.orders.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('user.orders.*') ? 'bg-orange-600' : 'hover:bg-gray-800' }} transition">
                    <i class="fas fa-receipt"></i>
                    <span>Riwayat Pesanan</span>
                </a>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-orange-600' : 'hover:bg-gray-800' }} transition">
                    <i class="fas fa-user-cog"></i>
                    <span>Pengaturan Profil</span>
                </a>

                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    <i class="fas fa-globe"></i>
                    <span>Ke Beranda</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <div class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-400">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button
                        class="w-full text-left flex items-center space-x-3 px-4 py-2 rounded-lg text-red-400 hover:bg-gray-800 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow overflow-y-auto">
            <div class="p-6 md:p-10">
                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Pengaturan Profil</h1>
                    <p class="text-gray-500 mt-1">Kelola informasi akun dan keamanan Anda</p>
                </div>

                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Profile Information -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Informasi Profil</h2>
                        <p class="text-sm text-gray-500 mt-1">Perbarui informasi profil dan alamat email Anda</p>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                Lengkap</label>
                            <input id="name" name="name" type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input id="email" name="email" type="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <p class="text-sm text-yellow-800">
                                        Email Anda belum diverifikasi.
                                        <button form="send-verification"
                                            class="underline text-yellow-900 hover:text-yellow-700">
                                            Klik di sini untuk mengirim ulang email verifikasi.
                                        </button>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit"
                                class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition font-semibold">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 font-medium">
                                    <i class="fas fa-check-circle mr-1"></i> Tersimpan!
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Ubah Password</h2>
                        <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan password yang kuat</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                Saat Ini</label>
                            <input id="current_password" name="current_password" type="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                Baru</label>
                            <input id="password" name="password" type="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi
                                Password Baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                autocomplete="new-password">
                            @error('password_confirmation', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit"
                                class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition font-semibold">
                                <i class="fas fa-key mr-2"></i> Ubah Password
                            </button>

                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 font-medium">
                                    <i class="fas fa-check-circle mr-1"></i> Password diubah!
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Hapus Akun</h2>
                        <p class="text-sm text-gray-500 mt-1">Hapus akun Anda secara permanen</p>
                    </div>

                    <p class="text-sm text-gray-600 mb-4">
                        Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. Sebelum
                        menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.
                    </p>

                    <button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Akun
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ show: false }"
        x-on:open-modal.window="$event.detail == 'confirm-user-deletion' ? show = true : null"
        x-on:close.stop="show = false" x-on:keydown.escape.window="show = false" x-show="show"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
        <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div x-show="show"
            class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-md sm:mx-auto"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Apakah Anda yakin ingin menghapus akun Anda?
                </h2>

                <p class="text-sm text-gray-600 mb-6">
                    Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. Masukkan password
                    Anda untuk mengonfirmasi penghapusan akun.
                </p>

                <div class="mb-6">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    @error('password', 'userDeletion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" x-on:click="show = false"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Verification Form (hidden) -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
</body>

</html>
