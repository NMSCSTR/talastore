<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Fork in the road: Decides which view to show
public function guestIndex()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('home');
    }

    // You MUST calculate this here too, or guest-form.blade.php will show ₱0
    $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

    return view('checkout.guest-form', compact('cart', 'total'));
}
    // Process the actual order
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart');

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'address'    => 'required',
            'phone'      => 'required',
        ]);

        // Create Order logic
        $order               = new Order();
        $order->user_id      = auth()->id(); // Null if guest
        $order->guest_email  = auth()->check() ? null : $request->email;
        $order->guest_name   = auth()->check() ? auth()->user()->name : $request->first_name . ' ' . $request->last_name;
        $order->total_amount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $order->status       = 'pending';
        $order->save();

        // Clear cart after successful order
        session()->forget('cart');

        return redirect()->route('home')->with('welcome', 'Order placed successfully! Check your email for details.');
    }
}
