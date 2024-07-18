<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey;
    protected $url = "https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_BVyERpbnRKV0SI0gwFFsFAVSFFuA2g0kO4cFQbge";

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }
    public function convert(string $from, string $to, float $amount = 1)
    {
        $q = "{$from}_{$to}";
        $request = Http::baseUrl($this->url)
            ->get("/convert", [
                'q' => $q,
                'compact' => 'y',
                'apiKey' => $this->apiKey,
            ]);

            $result = $request->json();
            dd($result);
            // return $amount * $result[$q]['val'];
    }
}
