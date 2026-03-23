@extends('components.default')

@section('title', 'Join Us | Tala Online Store')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-gray-100" data-aos="fade-up">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Create your account</h2>
            <p class="mt-2 text-sm text-gray-600">Start your journey with Tala</p>
        </div>

        <form class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input name="name" type="text" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input name="email" type="email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">I want to be a...</label>
                <select name="role" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                    <option value="customer">Customer</option>
                    <option value="supplier">Supplier</option>
                </select>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input name="password" type="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input name="password_confirmation" type="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="col-span-2">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    Register Account
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in here</a>
        </p>
    </div>
</div>
@endsection
