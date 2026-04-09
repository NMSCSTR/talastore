@extends('components.default')

@section('title', 'Your Shopping Bag | Tala Store')

@section('content')
<div class="bg-gray-50 min-h-screen pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
        <div class="flex items-center gap-4 mb-10">
            <a href="{{ route('home') }}" class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center text-gray-400 hover:text-blue-600 shadow-sm transition">
                <i class="fas fa-chevron-left"></i>
            </a>
            <h1 class="text-4xl font-black text-gray-900">Shopping <span class="text-blue-600">Bag</span></h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-6">
                @if(session('cart') && count(session('cart')) > 0)
                    @foreach(session('cart') as $id => $details)
                        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center gap-6 group transition-all hover:shadow-md">
                            <div class="h-28 w-28 bg-gray-50 rounded-[1.5rem] overflow-hidden">
                                <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://via.placeholder.com/150' }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-black text-gray-900 text-lg">{{ $details['name'] }}</h3>
                                <p class="text-sm text-gray-400 font-bold uppercase tracking-widest text-[10px]">Qty: {{ $details['quantity'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-xl text-gray-900">₱{{ number_format($details['price'] * $details['quantity']) }}</p>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="text-red-400 hover:text-red-600 text-[10px] font-black mt-2 transition uppercase">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-gray-200">
                        <h2 class="text-2xl font-black text-gray-900">Your bag is empty</h2>
                        <a href="{{ route('home') }}" class="mt-8 inline-block bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold">Start Shopping</a>
                    </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-50 sticky top-28">
                    <h2 class="text-xl font-black text-gray-900 mb-6 tracking-tight">Order Summary</h2>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-500 font-medium">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">₱{{ number_format($total ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500 font-medium">
                            <span>Shipping</span>
                            <span class="text-green-500 font-bold uppercase text-xs">Free</span>
                        </div>
                        <div class="border-t border-gray-100 pt-6 flex justify-between items-end">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-3xl font-black text-blue-600">₱{{ number_format($total ?? 0) }}</span>
                        </div>
                    </div>

                    @if(session('cart') && count(session('cart')) > 0)
                        <div class="space-y-4">
                            @guest
                                <a href="{{ route('checkout.guest') }}"
                                   class="w-full bg-gray-900 text-white py-5 rounded-2xl font-bold hover:bg-blue-600 transition-all flex flex-col items-center justify-center shadow-lg">
                                    <span class="flex items-center gap-2"><i class="fas fa-bolt text-yellow-400"></i> Guest Express</span>
                                    <span class="text-[10px] opacity-60 font-medium tracking-widest uppercase">No signup required</span>
                                </a>

                                <div class="relative py-2">
                                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
                                    <div class="relative flex justify-center text-[10px] font-black text-gray-400 uppercase tracking-widest"><span class="bg-white px-2">OR</span></div>
                                </div>

                                <a href="{{ route('login') }}"
                                   class="w-full bg-blue-50 text-blue-600 py-4 rounded-2xl font-bold hover:bg-blue-100 transition-all text-center text-sm border border-blue-100">
                                    Login for Member Rewards
                                </a>
                            @else
                                <a href="{{ route('checkout.index') }}"
                                   class="w-full bg-blue-600 text-white py-5 rounded-2xl font-bold hover:bg-gray-900 transition-all flex items-center justify-center gap-3 shadow-lg">
                                    Proceed to Payment <i class="fas fa-arrow-right"></i>
                                </a>
                            @endguest
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
