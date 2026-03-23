@extends('components.default')

@section('title', 'Tala Online Store | Quality at Your Doorstep')

@section('content')
<nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <img src="https://static.thenounproject.com/png/3173747-200.png" class="h-6 w-6 brightness-0 invert" alt="Logo">
                </div>
                <span class="text-xl font-black tracking-tighter text-gray-900">TALA<span class="text-blue-600">STORE</span></span>
            </div>

            <div class="hidden md:flex space-x-10 items-center">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Home</a>
                <a href="#shop" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Shop</a>

                @auth
                    <div class="h-6 w-px bg-gray-200"></div>
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                    @elseif(auth()->user()->role === 'supplier')
                        <a href="/supplier/inventory" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Inventory</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-blue-600 transition">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-gray-900 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-blue-600 transition shadow-xl shadow-gray-200">
                        Join Now
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<section class="relative bg-white pt-16 pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 text-center md:text-left z-10" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-600 uppercase bg-blue-50 rounded-full">
                New Collection 2026
            </span>
            <h1 class="text-6xl md:text-7xl font-black text-gray-900 leading-none mb-8">
                Shop Local. <br> <span class="text-blue-600">Live Better.</span>
            </h1>
            <p class="text-lg text-gray-500 mb-10 max-w-lg leading-relaxed">
                Experience the finest selection from Tala's Store. Quality products delivered straight to your doorstep.
            </p>
            <div class="flex flex-col sm:flex-row gap-5 justify-center md:justify-start">
                <a href="#shop" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-gray-900 transition-all shadow-2xl shadow-blue-200 hover:-translate-y-1">
                    Explore Store
                </a>
                @guest
                <a href="{{ route('register') }}" class="bg-white border-2 border-gray-100 text-gray-900 px-10 py-4 rounded-2xl font-bold hover:bg-gray-50 transition">
                    Sell with Us
                </a>
                @endguest
            </div>
        </div>
        <div class="md:w-1/2 mt-16 md:mt-0" data-aos="fade-left" data-aos-delay="200">
            <div class="relative">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
                <img src="https://illustrations.popsy.co/blue/online-shopping.svg" alt="Hero Illustration" class="w-full h-auto relative z-10">
            </div>
        </div>
    </div>
</section>

<section id="shop" class="py-24 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black text-gray-900 mb-4">Featured Products</h2>
            <p class="text-gray-500">Handpicked items just for you</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @forelse($products as $product)
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 border border-gray-100" data-aos="fade-up">
                <div class="h-64 bg-gray-50 relative overflow-hidden">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x400?text=' . urlencode($product->name) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur text-gray-900 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="font-bold text-gray-900 text-xl mb-1 truncate">{{ $product->name }}</h3>
                    {{-- <p class="text-xs text-blue-600 font-bold mb-3 uppercase tracking-tighter">Verified Supplier</p> --}}
                    <p class="text-sm text-gray-400 mb-6 line-clamp-2 leading-relaxed">{{ $product->description }}</p>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <span class="text-2xl font-black text-gray-900">₱{{ number_format($product->price, 0) }}</span>

                        {{-- Add to Cart Button with Logic --}}
                        <button
                            onclick="handleAddToCart('{{ $product->name }}')"
                            class="bg-gray-100 text-gray-900 h-12 w-12 rounded-2xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                            <i class="fas fa-shopping-basket"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-100">
                <p class="text-gray-400 font-medium">Our shelves are currently empty. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    function handleAddToCart(productName) {
        @auth
            // If logged in, you can add your actual AJAX cart logic here
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart',
                text: productName + ' has been added to your basket.',
                showConfirmButton: false,
                timer: 1500
            });
        @else
            // If not logged in, prompt to register
            Swal.fire({
                title: 'Want to buy this?',
                text: "Please create an account first to start shopping with Tala.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-user-plus mr-2"></i> Register Now',
                cancelButtonText: 'Maybe later'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('register') }}";
                }
            });
        @endauth
    }
</script>
@endsection
