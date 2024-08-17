<?php

namespace Database\Seeders;

use App\Models\Admin\EmailConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medias = [
            [
                'driver' => 'smtp',
                'host' => 'smtp.titan.email',
                'port' => '465',
                'encryption' => 'SSL',
                'username' => 'info@ahknoxo.com',
                'password' => 'Ahknoxo@gmail123',
                'sendermail' => 'info@ahknoxo.com',
            ]
        ];
  
        foreach ($medias as $key => $media) {
            EmailConfig::create($media);
        }
    }
}
