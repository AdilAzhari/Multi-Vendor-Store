<?php

namespace App\Repositories\Cart;

use App\Models\product;
use Illuminate\Support\Collection;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

interface CartsRepository
{
    public function get();
    public function delete(product $product);
    public function add(product $product, $quantity);
    public function update(product $product);
    public function empty();
    public function total(): float;
}
