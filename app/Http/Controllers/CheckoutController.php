<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    

    // public $checkout_message = '';

    public function checkout(Request $request)
    {
    

        $cart = session()->get('cart',[]);
        // $products = Product::select('id', 'quantity_left')->whereIn('id', $cart->pluck(value:'product_id'))->pluck('quantity', 'id');
        
        if(empty($cart))
        {
            return back()->with('error', 'Your Cart Is Empty.');
        }
        foreach($cart as $item) 
        { 
            $product = Product::find($item['id']); 
            if(!$product) 
            { 
                return back()->with('error', 'this item no longer exists.');
            }
            if($product->quantity<$item['quantity'])
            {
                return back()->with('error', 'we do not have enough stock of this item "{$product->name}"');
            }
        }

        DB::transaction(function() use($cart) {
            $order = Order::create([
                'user_id' =>auth()->id(),
                'total' => 0,
                'status' => 'pending',
                'payment_method' => 'cash'
            ]);

            $total = 0;
    
            foreach ($cart as $item){
                $product = Product::findOrFail($item['id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                $order->update(['total'=>$total,]);

                $total += $product->price * $item['quantity'];

                // $product->decrement('quantity', $item['quantity']);
            }
    
            // session()->forget('cart');
            // session()->forget('cartItemsTotal');
        });

        
    }

}
