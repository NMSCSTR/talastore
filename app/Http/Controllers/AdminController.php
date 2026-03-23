<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'userCount'     => User::count(),
            'supplierCount' => Supplier::count(),
            'productCount'  => Product::count(),
            'orderCount'    => Order::count(),
            'recentOrders'  => Order::with('user')->latest()->take(5)->get(),
        ]);
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role'     => 'required|in:admin,supplier,customer',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
        ]);

        return back()->with('welcome', 'User created successfully!');
    }

    public function updateUser(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,supplier,customer',
            'password' => 'nullable|min:8',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
        ]);
        
        $updateData = collect($data)->except('password')->all();
        $user->fill($updateData);

        if ($request->filled('password')) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return back()->with('welcome', 'Account details updated successfully!');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['msg' => 'You cannot delete yourself!']);
        }
        $user->delete();
        return back()->with('welcome', 'User deleted successfully!');
    }
}
