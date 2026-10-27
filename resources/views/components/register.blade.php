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
          <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
          <x-navbar-link href="/" :active="request()->is('/')">history</x-navbar-link>
          <x-navbar-link href="/" :active="request()->is('/')">Cart</x-navbar-link>
          <x-navbar-link href="/" :active="request()->is('/')">Logout</x-navbar-link>
        @endauth

        @guest
          <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
          <x-navbar-link href="/login" :active="request()->is('/')">Login</x-navbar-link>
        @endguest

      </ul>
    </div>
  </div>
</nav>

@endsection

@section('main')
    <div class="min-h-screen flex mt-20 justify-center">        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h2  class="text-xl font-semibold mb-4">Register your new account</h2>
            <x-input label="Name" name="name" type="text" value="{{ old('name') }}"/>
            <x-input label="Email" name="email" type="email" value="{{ old('email') }}"/>
            <x-input label="Password" name="password" type="password" />
            <x-input label="Confirm Password" name="password_confirmation" type="password" />
            <x-button>Register</x-button>
            @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100">
                    @foreach($errors->all() as $error)
                        <li class="my-2 text-red-500">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>
@endsection