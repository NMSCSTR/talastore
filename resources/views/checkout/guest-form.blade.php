@extends('components.default')

@section('title', 'Fast Checkout | Tala Store')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('cart.index') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 flex items-center gap-2">
                <i class="fas fa-chevron-left"></i> Return to Bag
            </a>
            <p class="text-sm font-black text-blue-600">⚡ Guest Express</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-50">
                <h2 class="text-2xl font-black text-gray-900 mb-2">Shipping Details</h2>
                <p class="text-sm text-gray-500 mb-8">Quick info for a fast delivery.</p>

                <form action="{{ route('checkout.guest.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="first_name" required placeholder="First Name" class="bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="last_name" required placeholder="Last Name" class="bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <input type="email" name="email" required placeholder="Email Address for tracking" class="w-full bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">
                    <input type="text" name="phone" required placeholder="Phone Number (09XX...)" class="w-full bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">
                    <textarea name="address" rows="3" required placeholder="Complete Address" class="w-full bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500"></textarea>

                    <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-bold shadow-lg shadow-blue-100 flex items-center justify-center gap-3 mt-4">
                        Complete Purchase <i class="fas fa-check-circle"></i>
                    </button>
                </form>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-900 text-white p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-lg font-bold mb-4">Summary</h3>
                    <div class="flex justify-between items-end">
                        <span class="text-sm opacity-60">Total to Pay</span>
                        <span class="text-3xl font-black">₱{{ number_format($total ?? 0) }}</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-8 rounded-[2.5rem] text-white shadow-xl">
                    <h4 class="font-black text-lg mb-4">Why join TALA?</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex gap-3"><i class="fas fa-truck-loading opacity-70"></i> <span>Track orders in real-time</span></li>
                        <li class="flex gap-3"><i class="fas fa-gift opacity-70"></i> <span>Earn points on every buy</span></li>
                        <li class="flex gap-3"><i class="fas fa-undo opacity-70"></i> <span>Easier returns & support</span></li>
                    </ul>
                    <p class="text-[10px] mt-8 opacity-60 italic text-center">You'll have a chance to save this order to a new account on the next page!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
