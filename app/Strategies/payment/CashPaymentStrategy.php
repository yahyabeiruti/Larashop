<?php

namespace App\Strategies\payment;

// use App\Strategies\Payment\PaymentStrategyInterface;

class CashPaymentStrategy implements PaymentStrategyInterface
{
    public function pay(float $amount, array $paymentData): array
    {
        $transactionId = 'cash' . uniqid();

        $success = $this->processCashPayment($amount, $paymentData);

        return [
            'success' => $success,
            'transaction_id' => $transactionId,
            'payment_methode' => $this ->getPaymentMethod(),
            'amount' => $amount
        ];

    }

    public function validate(array $paymentData): bool
    {
        return true;
    }

    public function getPaymentMethod(): string
    {
        return 'cash';
    }

    public function processCashPayment(float $amount, array $paymentData): bool
    {
        return true;
    }
}