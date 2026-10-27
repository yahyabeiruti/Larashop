<?php

namespace App\Services;
use App\Strategies\Payment\PaymentStrategyInterface;


class PaymentProcessor
{
    private PaymentStrategyInterface $strategy;

    public function __construct(PaymentStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(PaymentStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function processPayment(float $amount, array $paymentData): array
    {
        if(!$this->strategy->validate($paymentData))
        {
            throw new \InvalidArgumentException('Invalid payment data for ' . $this->strategy->getPaymentMethod());
        }

        return $this->strategy->pay($amount, $paymentData);
    }

    public function getPaymentMethode(): string
    {
        return $this->strategy->getPaymentMethod();
    }
}