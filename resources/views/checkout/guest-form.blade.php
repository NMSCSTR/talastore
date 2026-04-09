@extends('components.default')

@section('title', 'Fast Checkout | Tala Store')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4">

        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('cart.index') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 flex items-center gap-2">
                <i class="fas fa-chevron-left"></i> Return to Bag
            </a>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Checkout Mode</p>
                <p class="text-sm font-black text-blue-600">⚡ Guest Express</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-50">
                <h2 class="text-2xl font-black text-gray-900 mb-2">Shipping Details</h2>
                <p class="text-sm text-gray-500 mb-8">Where should we send your local finds?</p>

                <form action="{{ route('checkout.guest.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase ml-2">First Name</label>
                            <input type="text" name="first_name" required class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase ml-2">Last Name</label>
                            <input type="text" name="last_name" required class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase ml-2">Email Address</label>
                        <input type="email" name="email" required class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500" placeholder="For order tracking">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase ml-2">Phone Number</label>
                        <input type="text" name="phone" required class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500" placeholder="09XX XXX XXXX">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase ml-2">Complete Address</label>
                        <textarea name="address" rows="3" required class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500" placeholder="Street, Barangay, City, Province"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-bold hover:bg-gray-900 transition-all shadow-lg shadow-blue-100 flex items-center justify-center gap-3">
                            Complete Purchase
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-900 text-white p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-lg font-bold mb-4">Summary</h3>
                    <div class="space-y-3 opacity-80 text-sm">
                        <div class="flex justify-between">
                            <span>Items</span>
                            <span>₱{{ number_format($total ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span class="text-green-400 font-bold">FREE</span>
                        </div>
                    </div>
                    <div class="border-t border-white/10 mt-6 pt-6 flex justify-between items-end">
                        <span class="text-sm font-bold">Total to Pay</span>
                        <span class="text-3xl font-black">₱{{ number_format($total ?? 0) }}</span>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 p-8 rounded-[2.5rem]">
                    <div class="flex items-start gap-4">
                        <div class="bg-white p-3 rounded-xl shadow-sm text-blue-600">
                            <i class="fas fa-unlock-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Have an account?</h4>
                            <p class="text-sm text-blue-700/70 mb-4">Login to use saved addresses and earn rewards on this order.</p>
                            <a href="{{ route('login') }}" class="text-sm font-black text-blue-600 hover:underline">Sign in instead →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
