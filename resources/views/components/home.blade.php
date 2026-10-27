<!-- home.blade.php -->
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
<div class="max-w-7xl mx-auto px-6 py-10">
  <div class="row my-3">
    <div class="col-md-12 d-flex justify-content-between">
      @if(session()->has('cart'))
        <a href="{{ route('cart.index') }}" class="text-decoration-none text-black">
          <span class="fs-4 fw-bold">
            <i class="fas fa-shopping-cart fa-xl"></i>
            ({{ count(session()->get('cart')) }})
          </span>
        </a>
        <span class="fs-4 text-danger fw-bold">
          ${{ session()->get('cartItemsTotal') }}
        </span>
        @else
          <span class="fs-4 fw-bold">
            <i class="fas fa-shopping-cart fa-xl"></i>
            (0)
          </span>
      @endif
    </div>
  </div>
  <div class="flex flex-col h-full grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    
  @foreach ($products as $product)
    
      <div class="h-full bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200
           hover:shadow-xl transition duration-300">
          <img src="{{ asset($product->image) }}" alt="{{$product->name}}" class="h-72 w-full object-cover">
          <div class="p-5 flex flex-col">
            <div class="text-lg font-semibold text-[#1d3557]">
              {{ $product->name }}
            </div>
            <div class="mt-2 text-sm text-[#457b9d]">
              {{ $product->description }}
            </div>
            <p>
              <span class="text-2xl font-bold text-[#1d3557]">
                {{ $product-> price }}
              </span>
            </p>
            @if( $product -> quantity > 0 )
              <p class="text-green-600 font-semibold">
                {{ $product -> quantity }} In Stock
              </p>
              <div class="mt-auto pt-5">
              <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" class="" name="product_id" value="{{ $product->id }}">
                <x-pay-button><i class="fas fa-shopping-cart">  </i>   Add To Cart</x-pay-button>
            
              </form>
            </div>
            @else
              <p class="text-red-600 font-semibold">
                Out Of Stock
              </p>
              <div class="mt-auto pt-5">
              <form action="" method="">
                
                <x-pay-button class="bg-[#ee8088] hover:bg-[#ee8088]">
                  <i class="fas fa-shopping-cart">  </i>   Add To Cart
                </x-pay-button>
            
              </form>
            </div>
            @endif
            
      </div>
    </div>

  @endforeach
</div>

@endsection

@section('footer')

@endsection