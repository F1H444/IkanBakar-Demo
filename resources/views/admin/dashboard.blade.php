@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="p-4 rounded-full bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-shopping-cart text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Pesanan</p>
                <p class="text-2xl font-bold">{{ $totalOrders }}</p>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="p-4 rounded-full bg-green-100 text-green-600 mr-4">
                <i class="fas fa-money-bill-wave text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Pendapatan</p>
                <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="p-4 rounded-full bg-orange-100 text-orange-600 mr-4">
                <i class="fas fa-clock text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Pesanan Pending</p>
                <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
            </div>
        </div>

        <!-- Total Menus -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="p-4 rounded-full bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-utensils text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Menu</p>
                <p class="text-2xl font-bold">{{ $totalMenus }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Pesanan Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">ID</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Pelanggan</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Total</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Tanggal</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">#{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->customer_name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 text-xs rounded-full 
                                    {{ $order->status === 'completed'
                                        ? 'bg-green-100 text-green-800'
                                        : ($order->status === 'pending'
                                            ? 'bg-orange-100 text-orange-800'
                                            : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pesanan terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
