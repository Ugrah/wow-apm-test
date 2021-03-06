<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class ApiAuthController extends Controller
{
    //
    public $successStatus = 200;
    protected $successStatusCreate = 201;

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function login()
    {
        $credentials = ['email' => request('email'), 'password' => request('password')];
        if (Auth::attempt($credentials)) {
            // Auth::guard('web')->check($credentials);
            // auth()->guard('web')->attempt(request(['email', 'password']));
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => $success], $this->successStatusCreate);
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function user(Request $request)
    {
        // return $request->user();
        return response()->json(['success' => true, 'data' => $request->user()], $this->successStatusCreate);

        /*$user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);*/
    }
}
