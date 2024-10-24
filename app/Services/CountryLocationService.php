<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CountryLocationService
{
    private $countryUrl = 'https://restcountries.com/v3.1';

    private $addressUrl = 'https://nominatim.openstreetmap.org/search';

    private $locationIQ = 'https://us1.locationiq.com/v1/search.php';


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
        // $response =  Http::get($this->addressUrl, [

        //         'q' => $address,
        //         'format' => 'json',
        //         'addressdetails' => 4,
        //         'limit' => 5

        // ]);

        $response = Http::get($this->locationIQ, [
            // 'key' => 'pk.27883334841abc386c762fd717c6908f',
            'key' => env('LOCATION_IQ'),
            'q' => $address,
            'format' => 'json'
        ]);

        // dd($response->json());
        // dd(data_get($response->json(), 'error'));

        if($response->successful())
        {

            return array_map( function($value){
                return data_get($value, 'display_name');
            }, $response->json());
        }

        return ["An error occured: " . data_get($response->json(), 'error')];

    }
}
