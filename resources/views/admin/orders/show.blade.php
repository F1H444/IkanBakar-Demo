@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Item Pesanan</h2>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Menu</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Harga</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Qty</th>
                        <th class="px-6 py-3 bg-gray-50 text-gray-700 font-bold uppercase text-xs">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($item->menu->image)
                                        <img src="{{ asset($item->menu->image) }}"
                                            class="h-10 w-10 object-cover rounded mr-3" alt="{{ $item->menu->name }}">
                                    @endif
                                    <span class="font-semibold">{{ $item->menu->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 font-bold">Rp
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-50">
                        <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-700">Total Harga</td>
                        <td class="px-6 py-4 font-bold text-xl text-orange-600">Rp
                            {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Order Information & Actions -->
        <div>
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pelanggan</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pelanggan</p>
                        <p class="font-semibold">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Pesanan</p>
                        <p class="font-semibold">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Update Status</h2>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status Pesanan</label>
                        <select name="status" id="status"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="payment_status" class="block text-gray-700 text-sm font-bold mb-2">Status
                            Pembayaran</label>
                        <select name="payment_status" id="payment_status"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid
                            </option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
