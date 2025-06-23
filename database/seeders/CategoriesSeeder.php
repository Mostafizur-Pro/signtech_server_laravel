<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;


class CategoriesSeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            [
                'title' => '360 Cassette',
                'description' => '',
                'path' => '/products/360_cassette',
                'position' => 1,
                'image' => 'categories/360_round.webp',
                'type' => 'Indoor',
                'status' => 'active',
            ],
            [
                'title' => '4-Way Cassette',
                'description' => '',
                'path' => '/products/4-way-cassette',
                'position' => 2,
                'image' => 'categories/cassette.png',
                'type' => 'Indoor',
                'status' => 'active',
            ],
            [
                'title' => '1-Way Cassette',
                'description' => '',
                'path' => '/products/1-way-cassette',
                'position' => 2,
                'image' => 'categories/1-way.webp',
                'type' => 'Indoor',
                'status' => 'active',
            ],
            [
                'title' => 'Duct-Type',
                'description' => '',
                'path' => '/products/duct',
                'position' => 2,
                'image' => 'categories/duct.webp',
                'type' => 'Indoor',
                'status' => 'active',
            ],
            [
                'title' => 'Wall-Mounted',
                'description' => '',
                'path' => '/products/wall-mounted',
                'position' => 2,
                'image' => 'categories/wall.webp',
                'type' => 'Indoor',
                'status' => 'active',
            ],
            [
                'title' => 'Ceiling-Mounted',
                'description' => '',
                'path' => '/products/wall-mounted',
                'position' => 2,
                'image' => 'categories/ceiling.png',
                'type' => 'Indoor',
                'status' => 'active',
            ],
            [
                'title' => 'Ventilation ',
                'description' => '',
                'path' => '/products/ventilation',
                'position' => 2,
                'image' => 'categories/fa.png',
                'type' => 'Indoor',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            Categories::create($category);
        }
    }
}
