<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function __construct()
    {
        $this->_config = request('_config');
        // $this->middleware('auth.user', ['except' => ['userType', 'logout', 'login']]);
    }

    /** 
     * Process Design Management  - confluence
     * 
     * @return \Illuminate\Http\Response 
     */
    public function dashboard()
    {
        return view($this->_config['view']);
    }
}
