<?php

namespace Tests\Unit\Products;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Stock;
use App\Money\Money;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function it_uses_the_slug_for_the_route_key_name()
    {
        $product = new Product;
        $this->assertEquals($product->getRouteKeyName(), 'slug');
    }

    /** @test */
    public function it_has_many_variations()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(
            $variation = factory(ProductVariation::class)->make()
        );

        $this->assertInstanceOf(ProductVariation::class, $product->variations->first());

        // Sometimes you may need to determine if two models are the "same" or not. The is and isNot methods may be used to quickly verify two models have the same primary key, table, and database connection or not
        $this->assertTrue($product->variations->first()->is($variation));
    }

    /** @test */
    public function it_returns_money_instance_for_the_money()
    {
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(Money::class, $product->money);
    }

    /** @test */
    public function it_returns_a_formatted_price()
    {
        $product = factory(Product::class)->create([
            'price' => 1500,
        ]);

        $this->assertEquals('$15.00', $product->price_formatted);
    }

    /** @test */
    public function it_can_check_if_it_is_in_stock()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(
            $variation = factory(ProductVariation::class)->make()
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );

        $this->assertTrue($product->inStock());
    }

    /** @test */
    public function it_can_get_the_stock_count()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(
            $variation = factory(ProductVariation::class)->make()
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );

        $this->assertEquals(5, $product->stockCount());
    }
}
