<?php

namespace Database\Seeders;

use App\Models\Admin\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gateways = [
            [
                'name' => 'Cash On Delivery',
                'image' => '',
                'text' => 'Cash on Delivery basically means you will pay the amount of product while you get the item delivered to you.',
                'data' => '',
                'sandbox' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Stripe',
                'image' => '',
                'text' => 'Stripe is the faster & safer way to send money. Make an online payment via Stripe.',
                'data' => '{"key":"stripe_key","secret":"stripe_secret"}',
                'sandbox' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Paypal',
                'image' => '',
                'text' => 'PayPal is the faster & safer way to send money. Make an online payment via PayPal.',
                'data' => '{"client_id":"client_id","client_secret":"client_secret"}',
                'sandbox' => 1,
                'status' => 1,
            ],
            [
                'name' => 'SSLCommerz',
                'image' => '',
                'text' => 'SSL commerz is the faster & safer way to send money. Make an online payment via SSL commerz.',
                'data' => '{"store_id":"store_unique_id","store_password":"store_password"}',
                'sandbox' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Bkash',
                'image' => '',
                'text' => 'SSL commerz is the faster & safer way to send money. Make an online payment via SSL commerz.',
                'data' => '{"app_key":"bkash_app_key","username":"sandboxTokenizedUser02","password":"bkash_app_pass","callback_url":"http://127.0.0.1:8000/bkash/callback"}',
                'sandbox' => 1,
                'status' => 1,
            ]
        ];

        foreach ($gateways as $key => $value) {

            PaymentGateway::create($value);
        }
    }
}
