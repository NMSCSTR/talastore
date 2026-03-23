@extends('components.default')

@section('content')
<div class="min-h-screen bg-gray-50 flex">
    <aside class="w-64 bg-white border-r border-gray-100 hidden md:block">
        <div class="p-6">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-1.5 rounded-lg">
                    <img src="https://static.thenounproject.com/png/3173747-200.png" class="h-5 w-5 brightness-0 invert" alt="Logo">
                </div>
                <span class="font-black text-gray-900 tracking-tighter">TALA <span class="text-blue-600">ADMIN</span></span>
            </div>
        </div>

        <nav class="mt-6 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50' }} transition-all font-semibold text-sm">
                <i class="material-icons-outlined">dashboard</i> Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 transition-all font-semibold text-sm">
                <i class="material-icons-outlined">people</i> Users Management
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 transition-all font-semibold text-sm">
                <i class="material-icons-outlined">category</i> Categories
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 transition-all font-semibold text-sm">
                <i class="material-icons-outlined">inventory_2</i> All Products
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 transition-all font-semibold text-sm">
                <i class="material-icons-outlined">shopping_cart</i> Orders
            </a>
        </nav>

        <div class="absolute bottom-0 w-64 p-6 border-t border-gray-50">
            <form action="" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-red-500 font-bold text-sm hover:gap-4 transition-all">
                    Logout <i class="material-icons-outlined text-sm">logout</i>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col">
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8">
            <h2 class="font-bold text-gray-800">Welcome, {{ auth()->user()->name }}</h2>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-gray-900 leading-none">Administrator</p>
                    <p class="text-[10px] text-gray-400 font-medium">System Access</p>
                </div>
                <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-8">
            @yield('admin_content')
        </div>
    </main>
</div>
@endsection
