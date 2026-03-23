@extends('components.default')

@section('title', 'Tala Online Store | Quality at Your Doorstep')

@section('content')
<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-2">
                <img src="https://static.thenounproject.com/png/3173747-200.png" class="h-8" alt="Logo">
                <span class="text-xl font-bold text-blue-600">TALA ONLINE STORE</span>
            </div>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition">Home</a>
                <a href="#shop" class="text-gray-600 hover:text-blue-600 transition">Shop</a>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                    @elseif(auth()->user()->role === 'supplier')
                        <a href="/supplier/inventory" class="text-gray-600 hover:text-blue-600 transition">Inventory</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-50 text-red-600 px-5 py-2 rounded-full hover:bg-red-100 transition font-medium">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Join Now
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<section class="relative bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 text-center md:text-left" data-aos="fade-right">
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                Discover the <span class="text-blue-600">Perfect</span> Products for You.
            </h1>
            <p class="text-lg text-gray-600 mb-8 max-w-lg">
                Shop from local suppliers and high-quality brands all in one place. Fast delivery and secure payments
                guaranteed.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="#shop"
                    class="bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition-all transform hover:scale-105">
                    Start Shopping
                </a>
                @guest
                <a href="{{ route('register') }}"
                    class="bg-white border border-gray-200 text-gray-700 px-8 py-4 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Become a Supplier
                </a>
                @endguest
            </div>
        </div>
        <div class="md:w-1/2 mt-12 md:mt-0 relative" data-aos="zoom-in" data-aos-delay="200">
            <img src="https://illustrations.popsy.co/blue/online-shopping.svg" alt="Hero Illustration"
                class="w-full h-auto">
        </div>
    </div>
</section>

<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fas fa-truck"></i>
            </div>
            <h3 class="font-bold text-xl mb-2">Fast Shipping</h3>
            <p class="text-gray-500">Quick and reliable delivery to your doorstep.</p>
        </div>
        <div class="p-6" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 class="font-bold text-xl mb-2">Secure Payment</h3>
            <p class="text-gray-500">Multiple secure payment options for peace of mind.</p>
        </div>
        <div class="p-6" data-aos="fade-up" data-aos-delay="300">
            <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fas fa-store"></i>
            </div>
            <h3 class="font-bold text-xl mb-2">Local Suppliers</h3>
            <p class="text-gray-500">Supporting community businesses across the region.</p>
        </div>
    </div>
</div>

<section id="shop" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
                <div class="h-1 w-20 bg-blue-600 mt-2"></div>
            </div>
            <a href="#" class="text-blue-600 font-medium hover:underline">View All &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all group" data-aos="fade-up">
                <div class="h-48 bg-gray-100 rounded-xl mb-4 overflow-hidden relative">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300?text=' . urlencode($product->name) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <span class="absolute top-2 right-2 bg-white px-2 py-1 rounded-md text-xs font-bold text-blue-600 shadow-sm">
                        {{ $product->category->name }}
                    </span>
                </div>

                <h3 class="font-semibold text-gray-800 text-lg">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $product->description }}</p>

                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-blue-600">₱{{ number_format($product->price, 2) }}</span>
                    <button class="bg-gray-900 text-white p-2 rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500 italic">No products available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<footer class="bg-white border-t py-12">
    <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Tala Online Store. All rights reserved.</p>
    </div>
</footer>
@endsection
