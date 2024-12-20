<?php

namespace Database\Seeders;

use App\Models\Admin\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medias = [
            [
                'media_name' => 'Facebook',
                'app_id' => 'your-app-id',
                'app_secret' => 'your-app-secret',
                'redirect_url' => 'http://localhost:8000/auth/facebook/callback',
                'status' => 1,
            ],
            [
                'media_name' => 'Google',
                'app_id' => 'your-app-id',
                'app_secret' => 'your-app-secret',
                'redirect_url' => 'http://localhost:8000/auth/google/callback',
                'status' => 1,
            ]
        ];
  
        foreach ($medias as $key => $media) {
            SocialMedia::create($media);
        }
    }
}
