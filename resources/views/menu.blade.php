@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-20 bg-gradient-to-b from-orange-50 to-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-fire text-orange-600"></i> Menu Ikan Bakar
                </h1>
                <p class="text-gray-600 text-lg">Pilih menu favorit Anda dari berbagai pilihan ikan bakar terbaik</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" id="searchMenu" placeholder="Cari menu..."
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="md:w-48">
                        <select id="statusFilter"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="">Semua Status</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Menu Grid -->
            <div id="menuGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse (\App\Models\Menu::where('status', 'Tersedia')->get() as $menu)
                    <!-- Menu Card -->
                    <div class="menu-item bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full overflow-hidden"
                        data-name="{{ strtolower($menu->name) }}" data-status="{{ $menu->status }}">
                        <!-- Image -->
                        <div class="relative overflow-hidden h-56">
                            <img src="{{ Str::startsWith($menu->image, 'http') ? $menu->image : asset($menu->image) }}"
                                alt="{{ $menu->name }}"
                                class="w-full h-full object-cover transform hover:scale-110 transition duration-500">

                            <!-- Status Badge -->
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold shadow-lg {{ $menu->status == 'Tersedia' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    <i
                                        class="fas {{ $menu->status == 'Tersedia' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                    {{ $menu->status }}
                                </span>
                            </div>

                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $menu->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow">{{ $menu->description }}</p>

                            <!-- Price and Action -->
                            <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Harga</p>
                                    <p class="text-2xl font-bold text-orange-600">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                @if ($menu->status == 'Tersedia')
                                    <button
                                        class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg hover:shadow-xl">
                                        <i class="fas fa-shopping-cart mr-2"></i>Pesan
                                    </button>
                                @else
                                    <button disabled
                                        class="bg-gray-300 text-gray-500 px-6 py-3 rounded-lg font-semibold cursor-not-allowed">
                                        <i class="fas fa-ban mr-2"></i>Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <i class="fas fa-utensils text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Belum ada menu tersedia</p>
                    </div>
                @endforelse
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-20">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Tidak ada menu yang ditemukan</p>
            </div>
        </div>
    </div>

    <!-- JavaScript for Search and Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchMenu');
            const statusFilter = document.getElementById('statusFilter');
            const menuItems = document.querySelectorAll('.menu-item');
            const noResults = document.getElementById('noResults');
            const menuGrid = document.getElementById('menuGrid');

            function filterMenus() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                menuItems.forEach(item => {
                    const name = item.dataset.name;
                    const status = item.dataset.status;

                    const matchesSearch = name.includes(searchTerm);
                    const matchesStatus = !statusValue || status === statusValue;

                    if (matchesSearch && matchesStatus) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                // Show/hide no results message
                if (visibleCount === 0) {
                    menuGrid.classList.add('hidden');
                    noResults.classList.remove('hidden');
                } else {
                    menuGrid.classList.remove('hidden');
                    noResults.classList.add('hidden');
                }
            }

            searchInput.addEventListener('input', filterMenus);
            statusFilter.addEventListener('change', filterMenus);
        });
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
