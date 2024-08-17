<?php

namespace App\Helpers;

class CurrencyConverter
{
  	public static function convertCurrency($amount, $fromCurrency = 'bdt', $toCurrency = 'usd')
  	{
  		$url = 'apis.qubitbd.com/utilities/currency/conversion?currency='.$fromCurrency.'&to_currency='.$toCurrency.'&amount='.$amount;

        $headers = array(
            "Response-Type: application/json",
            "Username: shareiar",
            "Authorization: Basic 30fc3c19229636efe51c66d5053e4149"
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, 0);
        $resp = curl_exec($curl);
        $response = json_decode($resp, true);
        curl_close($curl);

        $amount = ceil($response['transaction_info']['conversion_details'][0]["asked_amount"]);

        return $amount;
    	
  	}
}