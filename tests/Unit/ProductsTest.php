<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_product_index()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }
}
