<?php

namespace App\Http\Controllers;

use App\Factories\PaymentStrategyFactory;
use App\Services\PaymentProcessor;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    public function __construct(private PaymentService $paymentService)
    {   }

    public function showChoosePaymentPage()
    {
        $paymentMethods = $this->paymentService->listAvailablePaymentMethods();

        $cartData = $this->paymentService->getCartData();

        return view('components.payment', compact('paymentMethods', 'cartData'));
    }

    public function showCreditCardPayment()
    {
        $cartData = $this->paymentService->getCartData();

        return view('paymentMethodsPages.creditCard', compact('cartData'));
    }

    public function processCardPayment(Request $request)
    {
        $validated = $request-> validate([
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
        ]);

        $paymentData = [
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'cvv' => $request->cvv,
        ];

        // return $this->processPayment(
            $request->merge([
                'payment_methode' => 'credit_card',
                'payment_data' => $paymentData
            ]);

        return $this->processPayment($request);
            
    }

    public function showCashPayment()
    {

        $cartData = $this->paymentService->getCartData();  
        return view('paymentMethodsPages.cash', compact('cartData'));
    }

    public function processCashPayment()
    {
        // dd("this is process cash one");
        
        // $paymentData = [];
        // $request->merge([
        //     'payment_methode' => 'cash',
        //     'payment_data' => []
        // ]);

        // dd("this is process cash two");

        return $this->processPayment('cash',[]);
    }

    public function showPaypalPayment()
    {
        $cartData = $this->paymentService->getCartData();  
        return view('paymentMethodsPages.paypal', compact('cartData'));
    }

    public function processPaypalPayment()
    {
        // $request->merge([
        //     'payment_methode' => 'paypal',
        //     'payment_data' => []
        // ]);

        return $this->processPayment('paypal', []);
    }

    public function processWalletPayment()
    {
        // $request->merge([
        //     'payment_methode' => 'wallet',
        //     'payment_data' => []
        // ]);

        return $this->processPayment('wallet', []);
    }

    public function showWalletPayment()
    {
        $cartData = $this->paymentService->getCartData(); 
        return view('paymentMethodsPages.wallet', compact('cartData'));
    }

    public function processPayment(string $method, array $paymentData)
    {
        
        // dd('this is the after life'); 
        // $request->validate([
        //     'payment_methode' => 'required|string',
        //     // 'amount' => 'required|numeric|min:0.01',
        //     'payment_data' => 'required|array'
        // ]);


        // dd('this is after it'); 

        // $request->validate([
        //     'payment_methode' => 'required|string',
        //     'payment_data' => 'nullable|array',
        //     'customer_name' => 'nullable'
        // ]);
        // the array is nullable due to the currant status of the app"no information varefication is applied"
        
        // dd('validation passed');
        

        $cart = session()->get('cart', []);

        $result = $this->paymentService->processPayment($cart, $method, $paymentData);

        if(!$result['status'])
        {
            return back()->with('error', $result['message']);
        }

        return redirect()->route('home')->with('success', $result['message']);

        // if (empty($cart)){
        //     return back()->with('error', 'Your Cart Is Empty');
        // }
        
        // foreach($cart as $item)
        // {
        //     $product = Product::find($item['id']);
            
        //     if(!$product) {
        //         return back()->with('error', "Product {$item['name']} Is Out Of Stock.");
        //     }

        //     if($product->quantity < $item['quantity'])
        //     {
        //         return back()->with('error', "Product {$item['name']} Don't have enough stock to meet your demand");
        //     }
        // }

        // $total = collect($cart)->sum(
        //     fn ($item) => $item['price'] * $item['quantity']
        // );
        
        // try{

        //     $order = DB::transaction(function()use($request, $cart, $total)
        //     {
            
        //         $order = Order::create([
        //             'user_id' => auth()->id(),
        //             'user_name' => auth()->user()->name,
        //             'total' => $total,
        //             'status' => 'pending',
        //             'payment_method' => $request->payment_methode,
        //         ]);
        
        //         foreach ($cart as $item){
        //             $order->items()->create([
        //                 'product_id' => $item['id'],
        //                 // 'order_id' => $order->id,
        //                 'quantity' => $item['quantity'],
        //                 'price' => $item['price'],
        //             ]);
        //         }

        //         $strategy = $this->strategyFactory->create($request->payment_methode);
        //         $processor = new PaymentProcessor($strategy);

        //         $result = $processor->processPayment(
        //             $total,
        //             $request->payment_data
        //         );
    
        //         if(!$result['success'])
        //         {
        //             $order->update([
        //                 'status' => 'failed',
        //             ]);
    
        //             return back()->with('error', 'payment failed');
        //         }
    
        //         $order->update([
        //             'status' => 'paid',
        //         ]);

        //         foreach($cart as $item)
        //         {
        //             $product = Product::find($item['id']);
                    
        //             $product->decrement(
        //                 'quantity', $item['quantity']
        //             );
        //         }

        //         return $order;

        // });
        //     // $result = $processor->processPayment(
        //     //     $request->amount,
        //     //     $request->payment_data
        //     // );

            

        //     session()->forget('cart');
        //     session()->forget('cartItemsTotal');

        //     return redirect()->route('home')->with('success', 'Payment Successful!');
        // }   
        // catch(\Exception $e)
        // {
        //     // $order->update([
        //     //     'status' => 'failed',
        //     // ]);
        //     // if (!$result['success']){
        //         dd($e->getMessage(), $e->getTraceAsString());
        //     // }
        // }

        
    }
}
