<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
    }

    public function login(Request $request)
    {
        // return response()->json(['error' => 'Unauthorised'], 401);

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|string',
        ]);

        $http = new \GuzzleHttp\Client(['base_uri' => env('API_BASE_URL')]);

        try {
            // $response = $http->post('/api/login', [
            //     'form_params' => [
            //         'grant_type' => 'password',
            //         'client_id' => $this->client->id,
            //         'client_secret' => $this->client->secret,
            //         'username' => $request->email,
            //         'password' => $request->password,
            //         // 'scope' => '*',
            //     ],
            // ]);
            $res = $http->request('POST', '/api/login', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $this->client->id,
                    'client_secret' => $this->client->secret,
                    'username' => $request->email,
                    'password' => $request->password,
                    // 'scope' => '*',
                ],
            ]);


            // $proxy = Request::create(
            //     'oauth/token',
            //     'POST'
            // );
            // return Route::dispatch($proxy);

            return $res->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() == 401) {
                return response()->json(['message' => 'This action can\'t be perfomed at this time. Please try later.'], $e->getCode());
            } else if ($e->getCode() == 400) {
                return response()->json(['message' => 'These credentials do not match our records.'], $e->getCode());
            }

            return response()->json('Something went wrong on the server. Please try letar.', $e->getCode());
        }
    }
}
