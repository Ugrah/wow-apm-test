<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Services\ApiService;
use Illuminate\Support\Facades\URL;

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
     * User Type 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function userType()
    {
        return view($this->_config['view']);
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

        $data = ['email' => $request->input('login'), 'password' => $request->input('password')];

        try {
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://apm-test.maxmind.ma/api']);
            $res = $client->request('POST', '/login', ['form_params' => $data]);
            // $res = $this->api_service->signin($data);
            $body = json_decode($res->getBody());
        } catch (\Exception $e) {
            // $responseBody = $e->getResponse()->getBody(true);
        }

        !empty($body->success->token) ? session()->put('token', $body->success->token) : null;

        // echo '<pre>',print_r($res,1),'</pre>';
        $result = !empty($body->success->token) ? 
        [
            'status' => $res->getStatusCode(),
            'content' => $res->getHeaderLine('content-type'),
            'result' => $body,
        ] : [
            'status' => 401,
            'content' => null,
            'result' => null,
        ];
        return response()->json($result, $result['status']);
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
