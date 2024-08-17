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
                'data' => '{"key":"pk_test_51HZI80H3jdWvr8gEn3oRtFlnJTqRpecXGQueOyngEArTyF6gjjfOVqbFeFMpAMRoQmKwPPrh81OiWzhDlqtS5nGs00gKycg4Oa","secret":"sk_test_51HZI80H3jdWvr8gErqdNWpqUkAgHMQdw7uug1mfUY38vIUfodsAWj4hoBK43rBvHebYETVX4ZCne03o3Ifco1qkR00dhrdpPsh"}',
                'sandbox' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Paypal',
                'image' => '',
                'text' => 'PayPal is the faster & safer way to send money. Make an online payment via PayPal.',
                'data' => '{"client_id":"AUtv8KISHG9l9rmlXB0cSLjt6A91IsGfPACeRreuRpEV3GR-ZRnxIxXnUVKNYIfqVXrxs2uPlGDot0Cc","client_secret":"EEdtOBI_NjI2bJzLSIzumsN_xSI7htn8qyAcRz0mvO8Emv-7CdfQeqxNZlDhiDAd0ZhV49e4sOhjtwho"}',
                'sandbox' => 1,
                'status' => 1,
            ],
            [
                'name' => 'SSLCommerz',
                'image' => '',
                'text' => 'SSL commerz is the faster & safer way to send money. Make an online payment via SSL commerz.',
                'data' => '{"store_id":"geniu5e1b00621f81e","store_password":"geniu5e1b00621f81e@ssl"}',
                'sandbox' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Bkash',
                'image' => '',
                'text' => 'SSL commerz is the faster & safer way to send money. Make an online payment via SSL commerz.',
                'data' => '{"app_key":"4f6o0cjiki2rfm34kfdadl1eqq","app_secret":"2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b","username":"sandboxTokenizedUser02","password":"sandboxTokenizedUser02@12345","callback_url":"http://127.0.0.1:8000/bkash/callback"}',
                'sandbox' => 1,
                'status' => 1,
            ]
        ];

        foreach ($gateways as $key => $value) {

            PaymentGateway::create($value);
        }
    }
}
