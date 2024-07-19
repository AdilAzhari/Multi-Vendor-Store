<?php

namespace App\Helpers;

use App\Services\CurrencyConverter;
use NumberFormatter;

class Currency
{
    public static function format($amount, $currency = null)
    {
        $base_currency = config('app.currency', 'MYR');

        $format = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        if (null === $currency) {
            $currency = session()->get('currency_code', $base_currency);
        }

        if ($currency != $base_currency) {
            $rate = cache()->get('currency_rates_' . $currency, 1);
            $amount = $amount * $rate;
        }

        return $format->formatCurrency($amount, $currency);
    }
}
