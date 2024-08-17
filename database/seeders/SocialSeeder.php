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
                'app_id' => '643929170080071',
                'app_secret' => '038b2100dff9a2a684c85959c0accf66',
                'redirect_url' => 'http://localhost:8000/auth/facebook/callback',
                'status' => 1,
            ],
            [
                'media_name' => 'Google',
                'app_id' => '915191002660-6hjno4cgnbcm5p1kb3t692trh7pc6ngh.apps.googleusercontent.com',
                'app_secret' => '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',
                'redirect_url' => 'http://localhost:8000/auth/google/callback',
                'status' => 1,
            ]
        ];
  
        foreach ($medias as $key => $media) {
            SocialMedia::create($media);
        }
    }
}
