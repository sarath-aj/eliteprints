<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
           'shop_name' => 'Laracom',
           'description' => 'Buy the Best T-shirts from laracom Stress no more about going store to store to find your perfect T-shirt. Whether it is girls’ or boys\' T-shirts, pick a style that best reflects your style.',
           'email' => 'sales@eliteprints.herokuapp.com',
           'phone' => '4444-555-333',
           'address' => 'No 11/1, RSZA St',
           'state' => 'Tamil Nadu',
           'city' => 'Chennai',
           'postal_code' => '600512',
           'country_id' => 1,
       ]);
    }
}