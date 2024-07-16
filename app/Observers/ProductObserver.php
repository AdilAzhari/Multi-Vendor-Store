<?php

namespace App\Observers;

use App\Models\product;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     */
    public function creating(product $product): void
    {
        $product->slug = str()->slug($product->name);
    }

    /**
     * Handle the product "updated" event.
     */
    public function updating(product $product): void
    {
        $product->slug = str()->slug($product->name);
    }
}
