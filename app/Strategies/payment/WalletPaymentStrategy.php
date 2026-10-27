<?php

namespace App\Strategies\payment;

// use App\Strategies\Payment\PaymentStrategyInterface;

class WalletPaymentStrategy implements PaymentStrategyInterface
{
    public function pay(float $amount, array $paymentData): array
    {
        $transactionId = 'wallet' . uniqid();

        $success = $this->processWalletPayment($amount, $paymentData); 

        return [
            'success' => $success,
            'transaction_id' => $transactionId,
            'payment_methode' => $this -> getPaymentMethod(),
            'amount' => $amount
        ];
    }

    public function validate(array $paymentData): bool
    {
        return true;
    }

    public function getPaymentMethod(): string
    {
        return 'wallet';
    }

    public function processWalletPayment(float $amount, array $paymentData): bool
    {
        return true;
    }
}