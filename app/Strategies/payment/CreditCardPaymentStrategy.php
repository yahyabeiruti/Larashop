<?php

namespace App\Strategies\Payment;

class CreditCardPaymentStrategy implements PaymentStrategyInterface
{
    public function pay(float $amount, array $paymentData): array
    {
        $transactionId = 'cc_' . uniqid();

        $success = $this->processCreditCardPayment($amount, $paymentData);

        return [
            'success' => $success,
            'transaction_id' => $transactionId,
            'payment_methode' => $this ->getPaymentMethod(),
            'amount' => $amount
        ];
    }

    public function validate(array $paymentData): bool
    {
        return isset($paymentData['card_number']) &&
        isset ($paymentData['cvv']) &&
        isset($paymentData['expiry_date']);
    }

    public function getPaymentMethod(): string
    {
        return 'credit_card';
        // return true; //this is templarely until real verification is implied
    }

    public function processCreditCardPayment(float $amount, array $paymentData): bool
    {
        return true;
    }
}