<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'levis',
            'wrangler',
            'fila',
            'roadster',
            'gucci',
            'stussy',
        ];

        collect($brands)->each(function ($name) {
            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        });
    }
}