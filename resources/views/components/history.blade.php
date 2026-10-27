@extends('components.layout')

@section('header')

<nav class=" bg-[#1d3557]">
  <div class=" flex flex-wrap items-center justify-between p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <!-- <img src="{{ asset('images/to-do-list.png') }}" class="h-8" alt="To Do Logo"> -->
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#f1faee]">Larashop</span>
    </a>
    
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0   dark:border-gray-700">

        @auth
          <x-navbar-link href="{{ route('home') }}" :active="request()->is('/')">Home</x-navbar-link>
          <x-navbar-link href="{{ route('cart.index') }}" :active="request()->is('/')">Cart</x-navbar-link>
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button  type="submit">Logout</button>
          </form>
          
        @endauth

        @guest
          <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
          <x-navbar-link href="/register" :active="request()->is('/')">Register</x-navbar-link>
        @endguest

      </ul>
    </div>
  </div>
</nav>

@endsection

@section('main')

    <div class="mx-auto max-w-7xl px-6 py-10">
        
        <h1 class="text-3xl font-bold text-[#1d3557]">
            Order History
        </h1>
    

        <p class="mt-2 text-[#457b9d]">
            View your previous orders and their details.
        </p>
        <!-- this is AI generated I do not take credit for it -->
        @forelse ($orders as $order)

        <div class="mb-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-[#1d3557]">
                        Order #{{ $order->id }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $order->created_at->format('M d, Y h:i A') }}
                    </p>
                </div>

                <div>
                    <p class="text-xl font-bold text-[#1d3557]">
                        ${{ number_format($order->total, 2) }}
                    </p>

                    <p class="font-semibold
                        {{ $order->status === 'paid' ? 'text-green-600' : '' }}
                        {{ $order->status === 'failed' ? 'text-red-600' : '' }}
                        {{ $order->status === 'pending' ? 'text-yellow-600' : '' }}">
                        {{ ucfirst($order->status) }}
                    </p>
                </div>
            </div>

            <div class="mt-4 border-t border-gray-200 pt-4">
                <p class="text-gray-700">
                    <span class="font-semibold">Customer:</span>
                    {{ $order->user_name ?? 'N/A' }}
                </p>

                <p class="mt-1 text-gray-700">
                    <span class="font-semibold">Payment method:</span>
                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                </p>
            </div>

        </div>

    @empty

        <div class="rounded-xl bg-white p-8 text-center shadow-sm">
            <p class="text-lg font-semibold text-[#1d3557]">
                No orders yet.
            </p>

            <a href="{{ route('home') }}"
               class="mt-4 inline-block rounded-lg bg-[#1d3557] px-5 py-3 text-white hover:bg-[#457b9d]">
                Browse Products
            </a>
        </div>

    @endforelse
    </div>

@endsection