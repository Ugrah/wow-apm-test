<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

use App\Services\ApiService;
use Illuminate\Support\Facades\URL;
use Cookie;

class UserMainController extends Controller
{
    //
    protected $_config;
    protected $api_service;

    public $success_status = 200;


    public function __construct(ApiService $api_service)
    // public function __construct()
    {
        $this->_config = request('_config');
        $this->api_service = $api_service;
        $this->middleware('auth.user')->only(['userType']);
    }

    /** 
     * login 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function login()
    {
        return view($this->_config['view']);
    }

    /** 
     * signin 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function signin(Request $request)
    {

        $body = null;
        $cookie = null;

        $data = ['email' => $request->input('login'), 'password' => $request->input('password')];
        // $client = new \GuzzleHttp\Client(['base_uri' => env('API_BASE_URL')]);

        try {
            // $res = $client->request('POST', '/api/login', ['form_params' => $data]);
            $res = $this->api_service->signin($data);
            $body = json_decode($res->getBody());
        } catch (\Exception $e) {
            // $responseBody = $e->getResponse()->getBody(true);
        }

        if (!empty($body->success->token)) {
            $minutes = 60;
            $cookie = cookie('api_token', $body->success->token, $minutes);
        } else {
            Cookie::queue(Cookie::forget('cookieName'));
        }

        // echo '<pre>',print_r($res,1),'</pre>';
        $result = !empty($body->success->token) ?
            [
                'status' => $res->getStatusCode(),
                'content' => $res->getHeaderLine('content-type'),
                'result' => $body,
                'redirectUrl' => route($this->_config['redirect'])
            ] : [
                'status' => 401,
                'content' => null,
                'result' => null,
            ];
        return response()->json($result, $result['status'])->cookie($cookie);
    }

    /** 
     * User Type 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function userType()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => env('API_BASE_URL')]);
        $res = $client->request('GET', '/api/user', [
            'headers' => [
                'Authorization: Bearer ' . Cookie::get('api_token'),
                // 'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json'
            ]
        ]);
        $body = $res->getBody();

        return view($this->_config['view'], compact('body'));
    }

    /**
     * Destroy session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     auth()->guard('user')->logout();

    //     return redirect()->route($this->_config['redirect']);
    // }
}
