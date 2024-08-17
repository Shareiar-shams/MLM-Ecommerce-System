<?php

namespace Database\Seeders;

use App\Models\Admin\Cookie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CookieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cookie = [
            [
                'text' =>'Your experience on this site will be improved by allowing cookies.',
                'status' => 1,
            ],
        ];

        foreach ($cookie as $key => $value) {

            Cookie::create($value);
        }
    }
}
