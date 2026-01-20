@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Kelola Pesanan</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Pelanggan</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Total</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Status</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Pembayaran</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Tanggal</th>
                    <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">#{{ $order->id }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $order->customer_name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                                {{ $order->status === 'completed'
                                    ? 'bg-green-100 text-green-800'
                                    : ($order->status === 'pending'
                                        ? 'bg-orange-100 text-orange-800'
                                        : ($order->status === 'cancelled'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-blue-100 text-blue-800')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                                {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order) }}"
                                class="text-blue-600 hover:text-blue-800 font-semibold">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
