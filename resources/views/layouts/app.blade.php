<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Ikan Bakar Nusantara') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<nav class="bg-white shadow fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-orange-600">IkanBakar</a>

        <ul class="hidden md:flex space-x-8 font-medium">
            <li><a href="/" class="hover:text-orange-600">Home</a></li>
            <li><a href="/menu" class="hover:text-orange-600">Menu</a></li>
            <li><a href="/tentang" class="hover:text-orange-600">Tentang</a></li>
            <li><a href="/kontak" class="hover:text-orange-600">Kontak</a></li>
        </ul>

        <div class="flex items-center space-x-4">
            @guest
                <a href="/login" class="text-gray-700 hover:text-orange-600 font-medium">Login</a>
                <a href="/register" class="border border-orange-600 text-orange-600 px-4 py-2 rounded-lg hover:bg-orange-600 hover:text-white">Register</a>
            @else
                <span class="font-medium">Hi, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- Content -->
<main class="pt-24">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-gray-300 py-6 mt-20 text-center">
    <p>© {{ date('Y') }} Ikan Bakar Nusantara. All rights reserved.</p>
</footer>

</body>
</html>
