<?php

namespace Database\Seeders;

use App\Models\Admin\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'type' => 'newletter',
                'image' => 'public/E6YQav53vOXnlRgLQO1mdmx7xJl7gIuNbPxjixQP.png',
                'delay_duration' => '1.00',
                'title' => 'Get 50% Discount.',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, facere nesciunt doloremque nobis debitis sint?',
                'url' => '#',
            ]
        ];
  
        foreach ($announcements as $key => $announcement) {
            Announcement::create($announcement);
        }
    }
}
