<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    protected $apiKey;
    public function __construct()
    {
        $this->apiKey = config('services.currency_converter.api_key');
    }

    public function getLatestRates()
    {
        $cacheKey = 'currency_rates';
        if (Cache()->has($cacheKey)) {
            return Cache()->get($cacheKey);
        }
        $response = Http::get('https://api.freecurrencyapi.com/v1/latest', [
            'apikey' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $rates = $response->json();
            Cache()->put($cacheKey, $rates, 3600);
            foreach ($rates['data'] as $currency => $rate) {
                Cache()->put('currency_rates_' . $currency, $rate, 3600);
                info("Cached rate for $currency: $rate");
            }
            return $rates;
        }

        return null;
    }

    public function convertCurrency($fromCurrency, $toCurrency,$amount=1)
    {
        $rates = $this->getLatestRates();

        if (!$rates || !isset($rates['data'][$fromCurrency]) || !isset($rates['data'][$toCurrency])) {
            return null;
        }

        $baseAmount = $amount / $rates['data'][$fromCurrency];
        $convertedAmount = $baseAmount * $rates['data'][$toCurrency];

        return $convertedAmount;
    }
}
