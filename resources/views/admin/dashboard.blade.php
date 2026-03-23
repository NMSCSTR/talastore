@extends('layouts.admin')

@section('title', 'Admin Dashboard | Tala Store')

@section('admin_content')
<div data-aos="fade-up" class="space-y-10 pb-10">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
                <i class="material-icons-outlined text-white text-3xl">analytics</i>
            </div>
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tala Store <span class="text-blue-600">Dashboard</span></h1>
                <p class="text-gray-500 font-medium">System Intelligence & Management</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button class="h-12 w-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-400 hover:text-blue-600 hover:border-blue-100 transition-all shadow-sm">
                <i class="material-icons-outlined">notifications</i>
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            <button type="button" onclick="confirmLogout()" class="group flex items-center gap-3 bg-white border border-red-100 text-red-600 px-6 py-3 rounded-2xl font-bold hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm shadow-red-50">
                <span class="text-sm">Sign Out</span>
                <i class="material-icons-outlined text-sm group-hover:rotate-12 transition-transform">logout</i>
            </button>
        </div>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-br from-gray-900 to-blue-900 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-blue-100">
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-white text-3xl md:text-4xl font-black mb-4">Good Day, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h2>
            <p class="text-blue-100/80 text-lg leading-relaxed mb-8">
                Your store has seen a <span class="text-green-400 font-bold">+12% increase</span> in activity this week. Check your latest supplier applications and pending orders.
            </p>
            <div class="flex gap-4">
                <a href="/admin/orders" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-xl font-bold transition-all">View Reports</a>
                <a href="/admin/products" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl font-bold transition-all border border-white/10">Manage Inventory</a>
            </div>
        </div>
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
        <img src="https://illustrations.popsy.co/white/success.svg" class="absolute hidden lg:block right-12 bottom-0 h-64 opacity-20 pointer-events-none" alt="deco">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <a href="/admin/users" class="group relative bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-blue-100/50 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="material-icons-outlined text-8xl">people</i>
            </div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 shadow-inner">
                    <i class="material-icons-outlined text-3xl">people</i>
                </div>
                <p class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-1">Total Users</p>
                <div class="flex items-center gap-3">
                    <h4 class="text-4xl font-black text-gray-900 tracking-tight">{{ $userCount }}</h4>
                    <span class="text-green-500 text-xs font-bold bg-green-50 px-2 py-1 rounded-lg">+4 today</span>
                </div>
            </div>
        </a>

        <a href="/admin/suppliers" class="group relative bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-purple-100/50 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="material-icons-outlined text-8xl">storefront</i>
            </div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="material-icons-outlined text-3xl">storefront</i>
                </div>
                <p class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-1">Suppliers</p>
                <h4 class="text-4xl font-black text-gray-900 tracking-tight">{{ $supplierCount }}</h4>
            </div>
        </a>

        <a href="/admin/products" class="group relative bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-green-100/50 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="material-icons-outlined text-8xl">inventory_2</i>
            </div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="material-icons-outlined text-3xl">inventory_2</i>
                </div>
                <p class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-1">Products</p>
                <h4 class="text-4xl font-black text-gray-900 tracking-tight">{{ $productCount }}</h4>
            </div>
        </a>

        <a href="/admin/orders" class="group relative bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-orange-100/50 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="material-icons-outlined text-8xl">shopping_cart</i>
            </div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="material-icons-outlined text-3xl">shopping_cart</i>
                </div>
                <p class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-1">Orders</p>
                <h4 class="text-4xl font-black text-gray-900 tracking-tight">{{ $orderCount }}</h4>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50/30">
            <div class="flex items-center gap-4">
                <div class="h-10 w-1 bg-blue-600 rounded-full"></div>
                <h4 class="font-black text-gray-900 text-2xl tracking-tight">Recent Transactions</h4>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 bg-white px-4 py-2 rounded-xl border border-gray-100 italic">Live Update Enabled</span>
                <a href="/admin/orders" class="bg-gray-900 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-600 transition-all shadow-lg shadow-gray-200">See All</a>
            </div>
        </div>
        <div class="p-8 overflow-x-auto">
            <table id="datatable" class="w-full text-sm text-left border-separate border-spacing-y-3">
                <thead class="text-gray-400 uppercase text-[11px] font-black tracking-[0.1em]">
                    <tr>
                        <th class="px-6 py-2">Transaction ID</th>
                        <th class="px-6 py-2">Customer Details</th>
                        <th class="px-6 py-2">Amount Paid</th>
                        <th class="px-6 py-2 text-center">Current Status</th>
                        <th class="px-6 py-2">Logged Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y-0">
                    @foreach($recentOrders as $order)
                    <tr class="hover:bg-blue-50/30 transition-all group bg-white">
                        <td class="px-6 py-5 rounded-l-2xl border-y border-l border-gray-50 font-bold text-blue-600">
                            <span class="bg-blue-50 px-3 py-1.5 rounded-lg font-mono">#{{ $order->id }}</span>
                        </td>
                        <td class="px-6 py-5 border-y border-gray-50">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-xs text-gray-500">
                                    {{ substr($order->user->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-gray-800">{{ $order->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 border-y border-gray-50 font-black text-gray-900 text-base">
                            ₱{{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-5 border-y border-gray-50 text-center">
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm {{ $order->status == 'delivered' ? 'bg-green-500 text-white' : 'bg-orange-400 text-white' }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-white animate-pulse"></span>
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 rounded-r-2xl border-y border-r border-gray-50 text-gray-400 font-bold">
                            {{ $order->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Sign Out?',
            text: "Are you sure you want to end your admin session?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb', // Tala Blue
            cancelButtonColor: '#64748b',  // Slate Gray
            confirmButtonText: 'Yes, logout',
            cancelButtonText: 'Stay logged in',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-6 py-3 font-bold',
                cancelButton: 'rounded-xl px-6 py-3 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the hidden logout form
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>
@endsection
