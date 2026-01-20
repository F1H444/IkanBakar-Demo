@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kategori Menu</h1>
        <a href="{{ route('admin.categories.create') }}"
            class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">
            <i class="fas fa-plus mr-2"></i> Tambah Kategori
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">No</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Nama Kategori</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Slug</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Jumlah Menu</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded">
                                {{ $category->menus_count }} Menu
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="text-blue-600 hover:text-blue-800 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
