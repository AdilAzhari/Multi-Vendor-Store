<?php

namespace App\Helpers;

use NumberFormatter;

class Currency
{
    public static function format($value, $currency)
    {
        $format = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        if (!$currency) {
            $currency = config('app.currency', 'USD');
        }
        return $format->formatCurrency($value, $currency);
    }
}
