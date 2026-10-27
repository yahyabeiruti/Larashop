<!-- namespace.views.components.payment.blade.php -->
@extends('components.layout')

@section('header')
<nav class=" bg-[#1d3557]">
  <div class=" flex flex-wrap items-center justify-between p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <!-- <img src="{{ asset('images/to-do-list.png') }}" class="h-8" alt="To Do Logo"> -->
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#f1faee]">Larashop</span>
    </a>
    
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 dark:border-gray-700">

      
        
        <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
        
    
      </ul>
    </div>
  </div>
</nav>
@endsection

@section('main')

@php
    $total = $cartData['total'] ?? 0;
@endphp

<div class="max-w-5xl mx-auto px-6 py-10">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">

        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-[#1d3557] mb-2">Customer Name</label>

            <input type="text" value="{{ auth()->user()->name }}" readonly="readonly" class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-gray-700">
        </div>

        <h2 class="text-3xl font-bold text-[#1d3557] mb-6 flex items-center gap-3">
            <i class="fas fa-credit-card"></i>
            Choose Your Favorite Payment Method
        </h2>

        <table class="w-full text-left border-collapse">
    <thead class="bg-[#1d3557] text-[#f1faee]">
        <tr>
            <th class="px-4 py-3">Payment Method</th>
            <th class="px-4 py-3 text-right">Action</th>
        </tr>
    </thead>

    <tbody>
        
            <tr class="border-b border-gray-200 hover:bg-[#f1faee] transition">

                <td class="py-4 px-3 text-[#457b9d] text-xl">
                    Credit Card
                </td>

                <td class="py-4 px-3 text-right">
                    <form action="{{ route('credit.pay') }}" method="get">
                        @csrf

                        <input
                            type="hidden"
                            name="payment_methode"
                            value="creditCard"
                        >

                        <input
                            type="hidden"
                            name="amount"
                            value="{{ $total }}"
                        >

                        <button
                            type="submit"
                            class="bg-[#457b9d] hover:bg-[#1d3557] text-white font-semibold px-5 py-2 rounded-lg transition"
                        >
                            Pay
                        </button>
                    </form>
                </td>

            </tr>
            <tr class="border-b border-gray-200 hover:bg-[#f1faee] transition">

                <td class="py-4 px-3 text-[#457b9d] text-xl">
                    Paypal
                </td>

                <td class="py-4 px-3 text-right">
                    <form action="{{ route('paypal.pay') }}" method="get">
                        @csrf

                        <input
                            type="hidden"
                            name="payment_methode"
                            value="paypal"
                        >

                        <input
                            type="hidden"
                            name="amount"
                            value="{{ $total }}"
                        >

                        <button
                            type="submit"
                            class="bg-[#457b9d] hover:bg-[#1d3557] text-white font-semibold px-5 py-2 rounded-lg transition"
                        >
                            Pay
                        </button>
                    </form>
                </td>

            </tr>
            <tr class="border-b border-gray-200 hover:bg-[#f1faee] transition">

                <td class="py-4 px-3 text-[#457b9d] text-xl">
                    Cash
                </td>

                <td class="py-4 px-3 text-right">
                    <form action="{{ route('cash.pay') }}" method="get">
                        @csrf

                        <input
                            type="hidden"
                            name="payment_methode"
                            value="cash"
                        >

                        <input
                            type="hidden"
                            name="amount"
                            value="{{ $total }}"
                        >

                        <button
                            type="submit"
                            class="bg-[#457b9d] hover:bg-[#1d3557] text-white font-semibold px-5 py-2 rounded-lg transition"
                        >
                            Pay
                        </button>
                    </form>
                </td>

            </tr>
            <tr class="border-b border-gray-200 hover:bg-[#f1faee] transition">

                <td class="py-4 px-3 text-[#457b9d] text-xl">
                    Wallet
                </td>

                <td class="py-4 px-3 text-right">
                    <form action="{{ route('wallet.pay') }}" method="get">
                        @csrf

                        <input
                            type="hidden"
                            name="payment_methode"
                            value="wallet"
                        >

                        <input
                            type="hidden"
                            name="amount"
                            value="{{ $total }}"
                        >

                        <button
                            type="submit"
                            class="bg-[#457b9d] hover:bg-[#1d3557] text-white font-semibold px-5 py-2 rounded-lg transition"
                        >
                            Pay
                        </button>
                    </form>
                </td>

            </tr>
        
    </tbody>

    <tfoot>
        <tr>
            <td class="px-4 py-4 text-right font-bold text-xl text-[#1d3557]">
                Total:
            </td>

            <td class="px-4 py-4 text-right font-bold text-xl text-[#e63946]">
                ${{ number_format($total, 2) }}
            </td>
        </tr>
    </tfoot>
</table>

    </div>
</div>

</div>
@endsection
