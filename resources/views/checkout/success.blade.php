@extends('components.default')

@section('title', 'Order Confirmed | Tala Store')

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center px-4 py-20">
    <div class="max-w-2xl w-full text-center">
        <div class="h-24 w-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
            <i class="fas fa-check text-4xl"></i>
        </div>

        <h1 class="text-4xl font-black text-gray-900 mb-2">Order Confirmed!</h1>
        <p class="text-gray-500 font-medium">Order #{{ $order->id }} is being processed.</p>
        <p class="text-sm text-gray-400 mt-1">Receipt sent to <span class="text-blue-600 font-bold">{{ $order->guest_email }}</span></p>

        <div class="mt-12 bg-white p-10 rounded-[3rem] shadow-2xl border border-gray-100 relative overflow-hidden">
            {{-- Decorative Background --}}
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-50 rounded-full"></div>

            <div class="relative z-10">
                <span class="inline-block bg-blue-100 text-blue-600 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">Member Benefit</span>
                <h3 class="text-2xl font-black text-gray-900 mb-4">Save this order to an account?</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-sm mx-auto">
                    Create a password now to track your package, save your address for next time, and earn <b>5% back</b> in rewards on this purchase.
                </p>

                <form action="{{ route('register') }}" method="GET" class="space-y-4">
                    {{-- Pre-fill email for them --}}
                    <input type="hidden" name="email" value="{{ $order->guest_email }}">

                    <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-bold hover:bg-gray-900 transition-all shadow-xl shadow-blue-100 flex items-center justify-center gap-3">
                        Create My Account
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <a href="{{ route('home') }}" class="inline-block mt-6 text-sm font-bold text-gray-400 hover:text-gray-600 transition">
                    Maybe later, return to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
