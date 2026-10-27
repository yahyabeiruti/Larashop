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

      
        
        <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
        <x-navbar-link href="/" :active="request()->is('/')">history</x-navbar-link>
        
    
      </ul>
    </div>
  </div>
</nav>
@endsection

