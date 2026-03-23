@extends('layouts.admin')

@section('title', 'Admin Dashboard | Tala')

@section('admin_content')
<div data-aos="fade-up">
    <h3 class="text-2xl font-black text-gray-900 mb-8">Dashboard Overview</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                <i class="material-icons-outlined">people</i>
            </div>
            <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Total Users</p>
            <h4 class="text-3xl font-black text-gray-900">{{ $userCount }}</h4>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4">
                <i class="material-icons-outlined">store</i>
            </div>
            <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Suppliers</p>
            <h4 class="text-3xl font-black text-gray-900">{{ $supplierCount }}</h4>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4">
                <i class="material-icons-outlined">inventory_2</i>
            </div>
            <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Total Products</p>
            <h4 class="text-3xl font-black text-gray-900">{{ $productCount }}</h4>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4">
                <i class="material-icons-outlined">shopping_bag</i>
            </div>
            <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Total Orders</p>
            <h4 class="text-3xl font-black text-gray-900">{{ $orderCount }}</h4>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h4 class="font-black text-gray-900 mb-6">Recent Transactions</h4>
        <table id="datatable" class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] font-black">
                <tr>
                    <th class="px-4 py-4">Order ID</th>
                    <th class="px-4 py-4">Customer</th>
                    <th class="px-4 py-4">Total Amount</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all">
                    <td class="px-4 py-4 font-bold text-gray-900">#{{ $order->id }}</td>
                    <td class="px-4 py-4">{{ $order->user->name }}</td>
                    <td class="px-4 py-4 font-bold">₱{{ number_format($order->total_amount, 2) }}</td>
                    <td class="px-4 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $order->status == 'delivered' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-gray-400">{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
