@extends('components.default')

@section('title', 'Your Shopping Bag | Tala Store')

@section('content')
<div class="bg-gray-50 min-h-screen pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
        <h1 class="text-4xl font-black text-gray-900 mb-10">Shopping <span class="text-blue-600">Bag</span></h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-6">
                {{-- Example Item Loop --}}
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-6 group">
                    <div class="h-24 w-24 bg-gray-50 rounded-2xl overflow-hidden">
                        <img src="https://via.placeholder.com/150" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900">Sample Product Name</h3>
                        <p class="text-sm text-gray-400">Category Name</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-lg text-gray-900">₱1,200</p>
                        <button class="text-red-400 hover:text-red-600 text-xs font-bold mt-2 transition">Remove</button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-50 sticky top-28">
                    <h2 class="text-xl font-black text-gray-900 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-500">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">₱1,200</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Shipping</span>
                            <span class="text-green-500 font-bold">FREE</span>
                        </div>
                        <div class="border-t border-gray-100 pt-4 flex justify-between">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-black text-blue-600">₱1,200</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @guest
                            {{-- Option A: Speed Checkout --}}
                            <a href="{{ route('checkout.guest') }}"
                               class="w-full bg-gray-900 text-white py-5 rounded-2xl font-bold hover:bg-blue-600 transition-all flex items-center justify-center gap-3 shadow-lg shadow-gray-200">
                                <i class="fas fa-bolt"></i>
                                Guest Checkout
                            </a>

                            <div class="relative py-2">
                                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
                                <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-gray-400 font-bold">OR</span></div>
                            </div>

                            {{-- Option B: Login for Benefits --}}
                            <a href="{{ route('login') }}"
                               class="w-full bg-blue-50 text-blue-600 py-5 rounded-2xl font-bold hover:bg-blue-100 transition-all flex items-center justify-center gap-3 border border-blue-100">
                                <i class="fas fa-user-circle"></i>
                                Login to Save Items
                            </a>
                            <p class="text-[10px] text-center text-gray-400 mt-4 leading-relaxed">
                                Logged in users earn <span class="text-blue-600 font-bold">Tala Points</span> and track orders in real-time.
                            </p>
                        @else
                            <a href="{{ route('checkout.index') }}"
                               class="w-full bg-blue-600 text-white py-5 rounded-2xl font-bold hover:bg-gray-900 transition-all flex items-center justify-center gap-3 shadow-lg shadow-blue-200">
                                Proceed to Payment
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
