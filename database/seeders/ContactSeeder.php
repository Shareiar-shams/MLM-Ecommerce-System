<?php

namespace Database\Seeders;

use App\Models\Admin\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'title' =>'Don’t hesitate to contact us if you need help.',
                'subtitle' =>'Velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accu santium olorem que laud antium id est laborum.',
                'address' => '70 Washington Square South New York, NY 10012, United States',
                'contact_number'=>'["(877) 834-1434","(877) 834-1255"]',
                'time_schedule'=>'["Monday – Friday: 8am – 4pm","Saturday – Sunday: 9am – 5pm"]',
                'email'=>'["ahvision@example.com","info@example.com"]',
                'location'=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57903.130260808284!2d91.81978233787376!3d24.899835747004527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375054d3d270329f%3A0xf58ef93431f67382!2sSylhet!5e0!3m2!1sen!2sbd!4v1689148443293!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            ],
        ];

        foreach ($contacts as $key => $value) {

            Contact::create($value);
        }
    }
}
