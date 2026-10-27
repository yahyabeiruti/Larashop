<?php

namespace App\Services\checkout;

use App\Factories\PaymentStrategyFactory;

class CheckoutService
{
    public function __construct(private PaymentStrategyFactory $factory)
    {
        
    }
}