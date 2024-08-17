<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Menu;

class MenuSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'name' => 'Home',
                'route' => 'main',
                'ordering' => 1,
            ],
            [
                'name' => 'About Us',
                'route' => 'about',
                'ordering' => 2,
            ],
            [
                'name' => 'Affiliate',
                'route' => 'affiliate',
                'ordering' => 3,
            ],
            [
                'name' => 'Products',
                'route' => 'products',
                'ordering' => 4,
            ],
            [
                'name' => 'Contact Us',
                'route' => 'contact',
                'ordering' => 5,
            ]
        ];
  
        foreach ($links as $key => $navbar) {
            Menu::create($navbar);
        }
    }
}
