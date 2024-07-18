<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyConverterController extends Controller
{
    protected $currencyService;
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }
    public function store(Request $request)
    {
        $currencyCode = $request->input('currency_code');
        session(['currency_code' => $currencyCode]);

        $convertedAmount = $this->currencyService->convertCurrency('USD', $currencyCode);

        return redirect()->back()->with('converted_amount', $convertedAmount);
    }
}
