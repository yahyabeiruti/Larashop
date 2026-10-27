<?php

namespace App\Strategies\payment;

// use App\Strategies\Payment\PaymentStrategyInterface;

class PayPalPaymentStrategy implements PaymentStrategyInterface
{
    public function pay(float $amount, array $paymentData): array
    {
        $transactionId = 'pp_' . uniqid();

        $success = $this->processPayPalPayment($amount, $paymentData);

        return [
            'success' => $success,
            'transaction_id' => $transactionId,
            'payment_methode' => $this->getPaymentMethod(),
            'amount' => $amount
        ];
    }

    public function validate(array $paymentData): bool
    {
        // return isset($paymentData['email']) && isset($paymentData['password']);

        return true; //this is because real verifecation is not applied yet
    }

    public function getPaymentMethod(): string
    {
        return 'paypal';
    }

    public function processPayPalPayment(float $amount, array $paymentData) : bool
    {
        return true;
    }
}