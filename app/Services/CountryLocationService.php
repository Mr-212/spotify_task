<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CountryLocationService
{
    private $countryUrl = 'https://restcountries.com/v3.1';

    private $addressUrl = 'https://nominatim.openstreetmap.org/search';


    public function countries($country)
    {
        $response =  Http::get($this->countryUrl. "/name/" . $country);


        if($response->successful())
        {

            return array_map( function($value){
                return data_get($value, 'name.common');
            }, $response->json());
        }

        return [];

    }


    public function address($address)
    {
        $response =  Http::get($this->addressUrl, [

                'q' => $address,
                'format' => 'json',
                'addressdetails' => 4,
                'limit' => 5

        ]);

        // dd($response->body());

        if($response->successful())
        {

            return array_map( function($value){
                return data_get($value, 'display_name');
            }, $response->json());
        }

        return [];

    }
}
