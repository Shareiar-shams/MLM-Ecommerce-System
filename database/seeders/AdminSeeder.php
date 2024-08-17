<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' =>'admin',
                'email' =>'admin@example.com',
                'password' => bcrypt('shareiar'),
                'status'=>'1',
                'phone'=>'01307665311',
                'image'=>'noimage.jpg',
                'position'=>'Administor',
            ],
        ];

        foreach ($admins as $key => $value) {

            Admin::create($value);
        }
    }
}
