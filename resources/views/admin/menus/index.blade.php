@extends('layouts.admin')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Menu</h1>
        <a href="{{ route('admin.menus.create') }}"
            class="mt-4 md:mt-0 bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition flex items-center shadow-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Menu Baru
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
        <form action="{{ route('admin.menus.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Menu</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama ikan..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="flex items-end">
                <button type="submit"
                    class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition mr-2">
                    Filter
                </button>
                <a href="{{ route('admin.menus.index') }}"
                    class="w-full bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 transition text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Menu</th>

                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 italic-last-child">
                    @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ Str::startsWith($menu->image, 'http') ? $menu->image : asset($menu->image) }}"
                                        class="w-12 h-12 rounded-lg object-cover bg-gray-100"
                                        onerror="this.src='https://via.placeholder.com/100?text=No+Image'">
                                    <div>
                                        <span class="block font-bold text-gray-800">{{ $menu->name }}</span>
                                        <span
                                            class="text-xs text-gray-500 truncate w-40 block">{{ $menu->description }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center">
                                    <span
                                        class="w-2 h-2 rounded-full mr-2 {{ $menu->status == 'Tersedia' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    {{ $menu->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.menus.edit', $menu) }}"
                                        class="text-blue-600 hover:bg-blue-50 p-2 rounded transition" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded transition"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                                Belum ada menu yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $menus->links() }}
        </div>
    </div>
@endsection
