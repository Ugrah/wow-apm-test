<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use URL;

class ApiService
{
    
    protected $api_url;
    protected $client;
    protected $user_token;
    protected $unauthorized_status = 401;

    public function __construct()
    {

        $this->api_url = URL::to('/api');
        $this->client = new \GuzzleHttp\Client(['base_uri' => env('API_BASE_URL')]);

        $this->user_token = Session::has('token') ? Session::get('token') : null;
    }

    public function signin($data)
    {
        return $this->client->request('POST', '/login', ['form_params' => $data]);

        // return $http_code == $this->unauthorized_status ? false : json_decode($result);
    }

    /**
     * Get Api User detail - Can use this method to check api connexion
     *
     * @return void
     */
    public function checkIfUserIsConnected()
    {
        if (!$this->user_token) return true;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url . '/user',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->user_token,
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json'
            ),
        ));

        $result = curl_exec($curl);

        curl_close($curl);
        // return json_decode($result);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        return $http_code == $this->unauthorized_status ? false : true;
    }
}
