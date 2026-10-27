<!-- cart.blade.php -->

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

@section('main')

<div class="max-w-5xl mx-auto px-6 py-10">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
          <h2 class="text-3xl font-bold text-[#1d3557] mb-6 flex items-center gap-3">
            <i class="fas fa-cart-arrow-down"></i>
            Your Shopping Cart
          </h2>
          @if(empty($cart))
            <div class="bg-[#a8dadc] text-[#1d3557] p-4 rounded-lg">
              Your Cart is empty
            </div>
          @else
            <table class="w-full text-left border-collapse">
              <thead class="bg-[#1d3557] text-[#f1faee]">
                  <tr class="border-b border-gray-200">
                      <th class="px-4 py-3">Product</th>
                      <th class="px-4 py-3">Quantity</th>
                      <th class="px-4 py-3">Price</th>
                      <th class="px-4 py-3">Subtotal</th>
                      <th class="px-4 py-3"></th>
                      
                  </tr>
              </thead>

              
                  <tbody>
                    @foreach($cart as $item)
                        <tr class="border-b border-gray-200 hover:bg-[#f1faee] transition">
                            <td class="py-4 px-3 text-[#457b9d] text-xl">{{ $item['name'] }}</td>

                            <td class="py-4 px-3 text-[#457b9d]">
                            <form action="{{ route('cart.update') }}" method="post">
                              @csrf
                              @method("PUT")

                              <input type="hidden" name="product_id"
                                    value="{{ $item['id'] }}">

                              <input type="number"
                                    class="w-20 rounded-lg border border-gray-300 px-3 py-2 text-center text-[#1d3557] focus:border-[#457b9d] focus:outline-none"
                                    min="1"
                                    name="quantity"
                                    value="{{ $item['quantity'] }}">

                              <x-pay-button class="border-[#1d3557] bg[#457b9d]">
                                  <i class="fas fa-pencil"></i>
                                  Update Product
                              </x-pay-button>
                            </form>
                            </td>

                            <td class="py-4 px-3 text-[#457b9d]">
                              <span class="font-semibold text-[#1d3557]">
                                  ${{ $item['price'] }}
                              </span>
                            </td>

                            <td class="py-4 px-3 text-[#457b9d]">
                              <span class="font-bold text-[#e63946]">
                                  ${{ $item['price'] * $item['quantity'] }}
                              </span>
                            </td>

                            <td class="py-4 px-3 text-[#457b9d]">
                              <form action="{{ route('cart.remove') }}" method="post">
                                @csrf
                                @method("DELETE")

                                <input type="hidden" name="product_id"
                                      value="{{ $item['id'] }}">
                                <x-pay-button type="submit">
                                    <i class="fas fa-xmark"></i>
                                    
                                </x-pay-button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="6" class="text-right font-bold text-xl">
                        Total     
                      </td>
                      <td colspan="2" class="fs-5">
                          {{ session('cartItemsTotal') }}
                      </td>
                    </tr>
                  </tfoot>    
              
            </table>
          @endif
        </div>
        <div class="flex justify-end mt-6">
          
          <a href="/payment">
            <button
              class="bg-[#e63946]
                  hover:bg-[#c92f3a]
                  text-white
                  font-semibold
                  px-6
                  py-3
                  rounded-lg
                  transition">
                  Proceed To Payment
            </button>
          </a>
          
        
        </div>
      </div>
    </div>
  </div>

@endsection

@section('footer')

@endsection