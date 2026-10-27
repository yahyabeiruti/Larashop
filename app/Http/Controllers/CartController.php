<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private array $cart;

    public function __construct()
    {
        $this->cart = session()->get('cart', []);
    }

    public function showPaymentPage()
    {
        $cart = $this->cart;
        return view('components.payment', compact('cart'));
    }

    public function index()
    {
        $cart = $this->cart;

        return view('components.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if(isset($this->cart[$product->id]))
        {
            return back()->with('info', 'product is added to your cart');
        }else{
            $this->cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                
            ];

            session()->put('cart', $this->cart);

            $this->calculateCartItemsTotal();
            
            return back()->with('success', 'product is already added to your cart');
        }
    }

    public function updateCart(Request $request)
    {
        $quantity = $request->quantity;

        $product = Product::findOrFail($request->product_id);

        if(isset($this->cart[$product->id]))
        {
            $this->cart[$product->id]['quantity'] = $quantity;

            session()->put('cart', $this->cart);

            $this->calculateCartItemsTotal();
            
        }
        return back()->with('success', 'Cart Updated Successfully');

    }

    public function removeCartItem(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        if(isset($this->cart[$product->id]))
        {
            unset($this->cart[$product->id]);

            session()->put('cart', $this->cart);

            $this->calculateCartItemsTotal();
            
        }
        return back()->with('success', 'Product Removed Successfully');

    }

    private function calculateCartItemsTotal()
    {
        $total = collect($this->cart)->sum(fn($item) => $item['price']*$item['quantity']);

        session()->put('cartItemsTotal', $total);
    }
}
