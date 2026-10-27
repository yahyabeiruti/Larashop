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
                <i class="fas fa-credit-card"></i>
                Card Payment
            </h2>

            <p class="text-gray-500 mb-8">
                Enter your card information to complete your purchase.
            </p>

            <div class="bg-[#f1faee] rounded-lg p-4 mb-8 flex justify-between items-center">
                <span class="font-semibold text-[#1d3557]">
                    Order Total
                </span>

                <span class="text-2xl font-bold text-[#e63946]">
                    ${{ number_format($total, 2) }}
                </span>
            </div>

            <form action="{{ route('credit.process') }}" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="payment_methode"
                    value="credit_card"
                >

                <div class="space-y-6">

                    {{-- Card Number --}}
                    <div>
                        <label
                            for="card_number"
                            class="block mb-2 font-semibold text-[#1d3557]"
                        >
                            Card Number
                        </label>

                        <input
                            type="text"
                            id="card_number"
                            name="card_number"
                            placeholder="1234 5678 9012 3456"
                            maxlength="19"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                   focus:outline-none focus:ring-2 focus:ring-[#457b9d]"
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label
                                for="expiry_date"
                                class="block mb-2 font-semibold text-[#1d3557]"
                            >
                                Expiry Date
                            </label>

                            <input
                                type="text"
                                id="expiry_date"
                                name="expiry_date"
                                placeholder="MM/YY"
                                maxlength="5"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                       focus:outline-none focus:ring-2 focus:ring-[#457b9d]"
                            >
                        </div>

                        <div>
                            <label
                                for="cvv"
                                class="block mb-2 font-semibold text-[#1d3557]"
                            >
                                CVV
                            </label>

                            <input
                                type="password"
                                id="cvv"
                                name="cvv"
                                placeholder="1234"
                                maxlength="4"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                       focus:outline-none focus:ring-2 focus:ring-[#457b9d]"
                            >
                        </div>

                    </div>
                    
                        <button
                            type="submit"
                            class="w-full bg-[#457b9d] hover:bg-[#1d3557]
                                text-white font-semibold py-3 rounded-lg
                                transition"
                        >
                            <i class="fas fa-lock mr-2"></i>
                            Pay ${{ number_format($total, 2) }}
                        </button>
                    
                </div>

            </form>

        </div>
    </div>

</div>

@endsection