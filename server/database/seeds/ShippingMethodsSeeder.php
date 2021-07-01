<?php

use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingMethod::create([
            'name' => 'Standard Shipping',
            'price' => 50,
        ]);

        ShippingMethod::create([
            'name' => 'Express Shipping',
            'price' => 100,
        ]);
    }
}