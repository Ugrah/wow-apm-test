<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use URL;
use Cookie;


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

        $this->user_token = Session::has('api_token') ? Session::get('api_token') : null;
    }

    public function signin($data)
    {
        return $this->client->request('POST', '/api/login', ['form_params' => $data]);
    }

    /**
     * Get Api User detail - Can use this method to check api connexion
     *
     * @return void
     */
    public function checkIfUserIsConnected()
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTk0ZjUwYmQwOGY5MWUxOGYyZmNjZjI3Zjg4YTllNjAyZmM2Nzg1OGYxYzgzNWRkYjM4MTM5ZGNiODNjYzc0OTViZWMzNTZlNzhlNWRhZDgiLCJpYXQiOjE2MDg4OTg3NDcsIm5iZiI6MTYwODg5ODc0NywiZXhwIjoxNjQwNDM0NzQ3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.dG5-wqUlvSALsE0UdcuUvAwITbTxwyMnGS4dJ9fYloeG13mMgWcwBHF6981M0Orece03--9JqU2hHlQnb_IyT_DTQQzR1U7Eb7_LFfyyA8VCisZ4gVehtCwaUziyg2sFhSPKd6EpZhbfQA9XhoZx8mC3gGgbYB-OZTgScnV326l6NCiPPbOlhZKuO7R48DFcAos1bXy98Sr3-RE0cb-qeGSQWo7ljg-L2VUnWlQUChTl61A6_hGi-lJZqbayfI-jWsB2Q5x0dyTBzx2s1IM33n4iyGdDbYSioVgb_5K1p-bRoBj3oT4eYcinGOHv-CddZD0ZMuXMbFa-tbf1qiU-znQ8LW02hK4lBalTSHHC8DIt5TEInlTfufVvIWZd4xpsXYpzs1gt5govxYJDXBRcgbwj33eYvCja5RcBwXffP4JG5NzcxSZ_1RjZqqk-S15EwlyblPCiNWErZCshRuj1U9OjoPWmEeXsmLlbosVniEhgROSpWPNB6WLdxv2NActtV_vDAJ2yt0ZM6Yi8eq2wZw9q_qTE3c85c4_z-kDXyaBwhXJ6BfySFOecaau5-GqXAlFlonp-58q-PRaCWI9V0bK2wiElJ5YEzVc0TZSJhA92BOjoAHp8D4d8LLnf3m2kCMguAdHeAzl5QwZ5Q4ZoJy5nv4IwOQuNAqIq_nrKjPw';
        return $this->client->request('GET', '/api/user', [
            'headers' => [
                'Authorization: Bearer ' . Cookie::get('api_token'),
                // 'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json'
            ]
        ]);

        // if (!$this->user_token) return true;

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $this->api_url . '/user',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        //     CURLOPT_TIMEOUT        => 120,      // timeout on response
        //     CURLOPT_MAXREDIRS      => 10,
        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_SSL_VERIFYHOST => 2,
        //     CURLOPT_HTTPHEADER => array(
        //         'Authorization: Bearer ' . $this->user_token,
        //         'Content-Type: application/x-www-form-urlencoded',
        //         'Accept: application/json'
        //     ),
        // ));

        // $result = curl_exec($curl);

        // curl_close($curl);
        // // return json_decode($result);

        // $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // return $http_code == $this->unauthorized_status ? false : true;
    }
}
