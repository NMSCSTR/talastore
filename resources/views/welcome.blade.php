@extends('components.default')

@section('title', 'Tala Online Store | Quality at Your Doorstep')

@section('content')
<nav class="bg-white/90 backdrop-blur-xl border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="bg-blue-600 p-2 rounded-xl group-hover:rotate-12 transition-transform duration-300">
                    <img src="https://static.thenounproject.com/png/3173747-200.png" class="h-6 w-6 brightness-0 invert" alt="Logo">
                </div>
                <span class="text-2xl font-black tracking-tighter text-gray-900">TALA<span class="text-blue-600">STORE</span></span>
            </a>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 transition">Home</a>
                <a href="#shop" class="text-sm font-bold text-gray-500 hover:text-blue-600 transition">Shop</a>

                <div class="h-6 w-px bg-gray-200 mx-2"></div>

                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-shopping-bag text-xl"></i>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-blue-600 text-white text-[10px] font-bold h-5 w-5 rounded-full flex items-center justify-center border-2 border-white">
                        {{ count((array) session('cart')) }}
                    </span>
                </a>

                @auth
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-3">
                            <div class="text-right hidden lg:block">
                                <p class="text-xs font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest">{{ auth()->user()->role }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2.5 rounded-xl bg-gray-50 text-gray-400 hover:text-red-500 hover:bg-red-50 transition">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-blue-600 transition">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 text-white px-8 py-3 rounded-2xl text-sm font-bold hover:bg-gray-900 transition-all shadow-lg shadow-blue-100">
                            Get Started
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<section class="relative pt-12 pb-24 lg:pt-20 lg:pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 text-center lg:text-left relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 mb-8 text-xs font-bold tracking-widest text-blue-700 uppercase bg-blue-50 rounded-full border border-blue-100">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    New Season Now Live
                </div>
                <h1 class="text-5xl lg:text-8xl font-black text-gray-900 leading-[0.9] mb-8 tracking-tight">
                    Shop Local. <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Live Better.</span>
                </h1>
                <p class="text-xl text-gray-500 mb-10 max-w-lg leading-relaxed mx-auto lg:mx-0">
                    Curating the finest local crafts and daily essentials, delivered with a touch of care.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#shop" class="group bg-gray-900 text-white px-10 py-5 rounded-2xl font-bold hover:bg-blue-600 transition-all flex flex-col items-center sm:items-start justify-center">
                        <span class="flex items-center gap-3">Start Shopping <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i></span>
                        <span class="text-[10px] opacity-60 font-medium">Guest checkout enabled</span>
                    </a>
                </div>
            </div>

            <div class="lg:w-1/2 relative">
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-blue-100 rounded-full blur-[100px] opacity-60 animate-pulse"></div>
                <div class="relative z-10 bg-gradient-to-tr from-blue-50 to-white p-4 rounded-[3rem] border border-white shadow-2xl">
                    <img src="https://illustrations.popsy.co/blue/online-shopping.svg" alt="Hero" class="w-full h-auto">
                    <div class="absolute bottom-8 -left-8 bg-white p-6 rounded-3xl shadow-2xl border border-gray-50 hidden sm:block animate-bounce-slow">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-bolt text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-black text-gray-900">Guest Express</p>
                                <p class="text-xs text-gray-400">Buy now, sign up later.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="shop" class="py-24 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-4xl font-black text-gray-900 mb-2 tracking-tighter">Editor's Choice</h2>
                <p class="text-gray-500 font-medium">Handpicked items that define quality and style.</p>
            </div>
            <div class="h-px flex-1 bg-gray-200 hidden md:block mx-8 mb-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @forelse($products as $product)
            <div class="group relative bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 hover:shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] transition-all duration-700">
                <div class="relative h-[420px] w-full overflow-hidden bg-gray-100">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x800?text=' . urlencode($product->name) }}"
                        class="w-full h-full object-cover transform scale-105 group-hover:scale-110 group-hover:-rotate-1 transition-all duration-1000 @if($product->stock <= 0) grayscale opacity-60 @endif">
                    <div class="absolute top-5 left-5 right-5 flex justify-between items-start pointer-events-none">
                        <span class="bg-white/80 backdrop-blur-md text-gray-900 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm border border-white/50">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <div class="absolute inset-x-4 bottom-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 z-20">
                        <div class="bg-white/70 backdrop-blur-2xl p-5 rounded-[2rem] border border-white/50 shadow-2xl">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-[10px] font-black text-blue-600 uppercase tracking-tighter mb-1">Available Now</p>
                                    <h3 class="font-black text-gray-900 text-lg leading-none">{{ $product->name }}</h3>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-black text-gray-900 leading-none">₱{{ number_format($product->price, 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 group-hover:opacity-0 transition-opacity duration-300 text-center">
                    <h3 class="font-black text-gray-900 text-xl tracking-tight">{{ $product->name }}</h3>
                    <span class="text-xl font-black text-blue-600">₱{{ number_format($product->price, 0) }}</span>
                </div>

                @if($product->stock > 0)
                <button
                    onclick="handleAddToCart('{{ $product->id }}', '{{ $product->name }}')"
                    class="absolute bottom-24 right-8 h-16 w-16 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-2xl shadow-blue-400 opacity-0 scale-50 group-hover:opacity-100 group-hover:scale-100 hover:bg-gray-900 hover:rotate-90 transition-all duration-500 z-30">
                    <i class="fas fa-plus text-xl"></i>
                </button>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-32 bg-white rounded-[4rem] border-2 border-dashed border-gray-100">
                <h3 class="text-2xl font-black text-gray-900">No products found</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function handleAddToCart(productId, productName) {
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-count').innerText = data.count;

            Swal.fire({
                icon: 'success',
                title: 'Added to Basket',
                html: `<b>${productName}</b> is ready for checkout.`,
                showConfirmButton: true,
                confirmButtonText: 'View Cart',
                showCancelButton: true,
                cancelButtonText: 'Continue Shopping',
                confirmButtonColor: '#2563eb',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('cart.index') }}";
                }
            });
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection
