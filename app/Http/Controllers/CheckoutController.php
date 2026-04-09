<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function guestIndex()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home');
        }


        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('checkout.guest-form', compact('cart', 'total'));
    }

// To this:
public function processGuestCheckout(Request $request)
{
    $cart = session()->get('cart');

    $request->validate([
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|email',
        'address'    => 'required',
        'phone'      => 'required',
    ]);

    $order               = new Order();
    $order->user_id      = auth()->id();
    $order->guest_email  = auth()->check() ? null : $request->email;
    $order->guest_name   = auth()->check() ? auth()->user()->name : $request->first_name . ' ' . $request->last_name;
    $order->total_amount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    $order->status       = 'pending';
    $order->save();

    session()->forget('cart');

    // Make sure this matches your new Success Blade route
    return redirect()->view('checkout.success', $order->id);
}
}
