<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Samsung Mini VRF',
            'category' => 'cassette',
            'price' => 12,
            'regular_price' => 14,
            'size' => '3 Ton',
            'refrigerant' => 'R410A',
            'general' => 'Compact Outdoor Unit',
            'capacity' => '8.0 HP',
            'power' => '380V / 60Hz',
            'model' => 'AM080FXMDGH',
            'unit' => 'Outdoor',
            'type' => 'wall-mounted',
            'image' => 'https://samsung-climatesolutions.com/content/dam/dtnl-aem-samsung-seace/products/cac/single-split/setin/cassette-360-r32/2019/images/ac071rn4pkgeu/ac071kn4dkh-eu_001_front_white.png/jcr:content/renditions/image-product-detail.png',
        ]);
    }
}
