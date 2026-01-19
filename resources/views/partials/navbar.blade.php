<nav class="bg-white shadow fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-orange-600">IkanBakar</a>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-8 font-medium">
            <li><a href="/" class="hover:text-orange-600">Home</a></li>
            <li><a href="/menu" class="hover:text-orange-600">Menu</a></li>
            <li><a href="/tentang" class="hover:text-orange-600">Tentang</a></li>
            <li><a href="/kontak" class="hover:text-orange-600">Kontak</a></li>
        </ul>

        <!-- Auth -->
        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600 font-medium">Login</a>
                <a href="{{ route('register') }}" class="border border-orange-600 text-orange-600 px-4 py-2 rounded-lg hover:bg-orange-600 hover:text-white">Register</a>
            @else
                <span class="hidden md:inline font-medium">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

