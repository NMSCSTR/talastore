<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    // Fork in the road: Decides which view to show
    public function guestIndex()
    {
        if (auth()->check()) {
            return redirect()->route('checkout.index');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('home');

        return view('checkout.guest-form');
    }

    // Process the actual order
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart');

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
        ]);

        // Create Order logic
        $order = new Order();
        $order->user_id = auth()->id(); // Null if guest
        $order->guest_email = auth()->check() ? null : $request->email;
        $order->guest_name = auth()->check() ? auth()->user()->name : $request->first_name . ' ' . $request->last_name;
        $order->total_amount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $order->status = 'pending';
        $order->save();

        // Clear cart after successful order
        session()->forget('cart');

        return redirect()->route('home')->with('welcome', 'Order placed successfully! Check your email for details.');
    }
}
