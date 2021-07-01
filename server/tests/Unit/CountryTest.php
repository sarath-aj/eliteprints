<?php

namespace Tests\Unit\Models;

use App\Models\Country;
use App\Models\ShippingMethod;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /** @test */
    public function it_belongs_to_many_shipping_methods()
    {
        $country = factory(Country::class)->create();

        $country->shippingMethods()->attach(
            factory(ShippingMethod::class)->create()
        );

        $this->assertInstanceOf(ShippingMethod::class, $country->shippingMethods->first());
    }
}
