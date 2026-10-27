<?php

namespace App\Strategies\Payment;

interface PaymentStrategyInterface
{
    public function pay(float $amount, array $paymentData): array;
    public function validate(array $paymentData): bool;
    public function getPaymentMethod(): string;
}