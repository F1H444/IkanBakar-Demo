@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex items-center space-x-4">
        <a href="{{ route('admin.menus.index') }}" class="text-orange-600 hover:bg-orange-50 p-2 rounded-lg transition">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">{{ isset($menu) ? 'Ubah Menu' : 'Tambah Menu Baru' }}</h1>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <form action="{{ isset($menu) ? route('admin.menus.update', $menu) : route('admin.menus.store') }}" method="POST"
                enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                @if (isset($menu))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ikan / Menu</label>
                        <input type="text" name="name" value="{{ old('name', $menu->name ?? '') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Ikan Bakar Jimbaran">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $menu->price ?? '') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition @error('price') border-red-500 @enderror"
                            placeholder="35000">
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>



                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Stok</label>
                        <div class="flex space-x-4 mt-3">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="status" value="Tersedia"
                                    {{ old('status', $menu->status ?? 'Tersedia') == 'Tersedia' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-orange-600 border-gray-300 focus:ring-orange-500">
                                <span class="ml-2 text-gray-700 font-medium">Tersedia</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="status" value="Habis"
                                    {{ old('status', $menu->status ?? '') == 'Habis' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-red-600 border-gray-300 focus:ring-red-500">
                                <span class="ml-2 text-gray-700 font-medium">Habis</span>
                            </label>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Menu</label>
                        <input type="file" name="image"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @if (isset($menu) && $menu->image)
                            <div class="mt-4">
                                <p class="text-xs text-gray-500 mb-2">Foto Saat Ini:</p>
                                <img src="{{ Str::startsWith($menu->image, 'http') ? $menu->image : asset($menu->image) }}"
                                    class="w-32 h-32 rounded-lg object-cover border">
                            </div>
                        @endif
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Menu</label>
                        <textarea name="description" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition @error('description') border-red-500 @enderror"
                            placeholder="Jelaskan kelezatan menu ini...">{{ old('description', $menu->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit"
                        class="bg-orange-600 text-white px-10 py-3 rounded-lg hover:bg-orange-700 transition shadow-lg font-bold">
                        {{ isset($menu) ? 'Simpan Perubahan' : 'Tambah Menu' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
