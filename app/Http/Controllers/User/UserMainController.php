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
        $this->middleware('auth.user', ['except' => ['userType', 'logout', 'login']]);
    }

    /** 
     * login 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function login()
    {
        //    if(true) return redirect()->route($this->_config['redirect']);

        // Cookie::queue(Cookie::forget('api_token'));
        return view($this->_config['view']);
    }

    /** 
     * login 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function loginTest()
    {
        return view($this->_config['view']);
    }

    /** 
     * User Type 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function userType(Request $request)
    {
        if( (!Auth::check()) && (!Auth::attempt(['email' => request('login'), 'password' => request('password')])))  {
        // if (!Auth::check()) {
            return redirect()->route($this->_config['redirect']);
        }

        $api_token = $request->input('api_token');
        if ($api_token) session()->put('api_token', $api_token);

        return view($this->_config['view']);
    }

    /** 
     * login 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function dashboard()
    {
        return view($this->_config['view']);
    }

    /**
     * Destroy session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // auth()->guard('user')->logout();

        return redirect()->route($this->_config['redirect']);
    }
}
