<?php

namespace App\Services;

use App\Factories\PaymentStrategyFactory;
use App\Services\PaymentProcessor;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaymentService
{
    public function __construct(
        private PaymentStrategyFactory $paymentStrategyFactory
    ){}

    public function showChoosePaymentPage()
    {
        //
    }

    public function showCreditCardPayment()
    {
        //
    }

    // use in: showChoosePaymentPage
    public function listAvailablePaymentMethods()
    {
        return $this->paymentStrategyFactory->getAvailableStrategies(); 
    }

    // use in:
    // showChoosePaymentPage
    // showCreditCardPayment
    // showCashPayment
    // showPaypalPayment
    // showWalletPayment
    public function getCartData() : array
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(
                fn ($item) => $item['price'] * $item['quantity']
            );

        return[
            'cart' => $cart,
            'total' => $total,
        ];
    }

    // use in: processPayment
    public function validateCart(array $cart) : array
    {
        if (empty($cart)){
            return ['status' => false, 'message' => 'Your cart is empty'];
        }

        foreach ($cart as $item)
        {
            $product = Product::find($item['id']);

            if(!$product)
            {
                return ['status' => false, 'message' => 'Product {$item["name"]} Is Out of Stock'];
            }
            if($product->quantity<$item['quantity'])
            {
                return ['status' => false, 'message' => 'Product {$item["name"]} does not have enough stock to meet your demand'];
            }

        }

        return ['status' => true, 'message' => 'Item Added Successfully'];

    }

    // use inside: processPayment
    public function processPayment(array $cart, string $paymentMethod, array $paymentData) : array
    {
        $validation = $this->validateCart($cart);

        if(!$validation['status'])
        {
            return $validation;
        }

        $total = collect($cart)->sum(
            function ($item)
            {
                return $item['price'] * $item['quantity'];
            }
        );
        
        try{
            DB::transaction(function()use($paymentMethod, $paymentData, $cart, $total)
            {
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                    'total' => $total,
                    'status' => 'pending',
                    'payment_method' => $paymentMethod,
                ]);

                foreach ($cart as $item){
                    $order->items()->create([
                        'product_id' => $item['id'],
                        // 'order_id' => $order->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }

                $strategy = $this->paymentStrategyFactory->create($paymentMethod);
                $processor = new PaymentProcessor($strategy);

                $result = $processor->processPayment(
                    $total,
                    $paymentData
                );
    
                if(!$result['success'])
                {
                    $order->update([
                        'status' => 'failed',
                    ]);
    
                    return ['status' => false, 'message' => 'Sorry, Something Went Wrong, payment failed'];
                }
    
                $order->update([
                    'status' => 'paid',
                ]);

                foreach($cart as $item)
                {
                    $product = Product::find($item['id']);
                    
                    $product->decrement(
                        'quantity', $item['quantity']
                    );
                }

                return $order;
            });

            session()->forget('cart');
            session()->forget('cartItemsTotal');

            return ['status' => true, 'message' => 'Payment Seccessful!'];
        }

        catch(\RuntimeException $e)
        {
            return['status' => false, 'message' => $e->getMessage()];
        }
        catch(\Exception $e)
        {
            report($e);

            

            return ['status' => false, 'message' => 'Something Went Wrong, Please Try Again'];
        }
    }



}