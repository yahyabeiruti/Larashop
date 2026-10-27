@extends('components.layout')

@section('header')
<nav class="bg-[#1d3557]">
    <div class="flex items-center justify-between p-4">
        <a href="/" class="flex items-center">
            <span class="text-2xl font-semibold text-[#f1faee]">
                Larashop
            </span>
        </a>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0   dark:border-gray-700">

                    @auth
                <x-navbar-link class="text-[#f1faee]  md:hover:bg-transparent md:hover:text-blue-700 
                dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white" href="{{ route('home') }}" :active="request()->is('/')">Home</x-navbar-link>
                <x-navbar-link class="text-[#f1faee]  md:hover:bg-transparent md:hover:text-blue-700 
                dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white" href="/history" :active="request()->is('/history')">history</x-navbar-link>
                <x-navbar-link class="text-[#f1faee]  md:hover:bg-transparent md:hover:text-blue-700 
                dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white" href="{{ route('cart.index') }}" :active="request()->is('/')">Cart</x-navbar-link>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="text-[#f1faee]  md:hover:bg-transparent md:hover:text-blue-700 
                dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white"  type="submit">Logout</button>
                </form>
                @endauth

                @guest
                <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
                <x-navbar-link href="/login" :active="request()->is('/')">Login</x-navbar-link>
                <x-navbar-link href="/register" :active="request()->is('/')">Register</x-navbar-link>
                @endguest

            </ul>
        </div>
    </div>
</nav>
@endsection

@section('main')
@php
    $total = $cartData['total'] ?? 0;
@endphp
<div class="max-w-3xl mx-auto px-6 py-10">

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="p-8">

            <h2 class="text-3xl font-bold text-[#1d3557] mb-2 flex items-center gap-3">
                <i class="fab fa-paypal"></i>
                PayPal Payment
            </h2>

            <p class="text-gray-500 mb-8">
                Confirm your order and continue with PayPal to complete your purchase.
            </p>

            <div class="bg-[#f1faee] rounded-lg p-4 mb-8 flex justify-between items-center">
                <span class="font-semibold text-[#1d3557]">
                    Order Total
                </span>

                <span class="text-2xl font-bold text-[#e63946]">
                    ${{ number_format($total, 2) }}
                </span>
            </div>

            <form action="{{ route('paypal.process') }}" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="payment_methode"
                    value="paypal"
                >

                <div class="space-y-6">

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">

                        <i class="fab fa-paypal text-5xl text-[#0070ba] mb-4"></i>

                        <h3 class="text-xl font-semibold text-[#1d3557] mb-2">
                            Pay securely with PayPal
                        </h3>

                        <p class="text-gray-500">
                            You will be redirected to PayPal to securely complete your payment.
                        </p>

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#0070ba] hover:bg-[#003087]
                               text-white font-semibold py-3 rounded-lg
                               transition"
                    >
                        <i class="fab fa-paypal mr-2"></i>
                        Continue with PayPal
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection