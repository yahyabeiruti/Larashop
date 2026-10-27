<?php

namespace App\Factories;

use App\Strategies\Payment\CashPaymentStrategy;
use App\Strategies\Payment\CreditCardPaymentStrategy;
use App\Strategies\Payment\PaymentStrategyInterface;
use App\Strategies\Payment\PayPalPaymentStrategy;
use App\Strategies\Payment\WalletPaymentStrategy;

class PaymentStrategyFactory
{
    private array $strategies = [];

    public function __construct()
    {
        $this->strategies = [
            'credit_card' => CreditCardPaymentStrategy::class,
            'paypal' => PayPalPaymentStrategy::class,
            'cash' => CashPaymentStrategy::class,
            'wallet' => WalletPaymentStrategy::class

        ];
    }

    public function create(string $paymentMethod): PaymentStrategyInterface
    {
        if (!isset($this->strategies[$paymentMethod])) {
            throw new \InvalidArgumentException("Payment method '{$paymentMethod}' not supported");
        }

        $strategyClass = $this->strategies[$paymentMethod];
        return app($strategyClass);
    }

    public function getAvailableStrategies(): array
    {
        return array_keys($this->strategies);
    }
}