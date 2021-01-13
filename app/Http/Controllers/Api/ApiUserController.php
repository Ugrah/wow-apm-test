<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use Illuminate\Support\Arr;

class ApiUserController extends Controller
{
    protected $success_status = 200;
    protected $success_create_status = 201;
    protected $bas_request = 400;
    protected $no_data_available_status = 403;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware(['role:ADMIN'], ['except' => []]);

        // $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        // // $this->middleware('role:role-create', ['only' => ['create', 'store']]);
        // $this->middleware('role:admin', ['only' => ['create', 'store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return response()->json($users, $users ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMemebers($members_id)
    {
        if($members_id) $members_id = explode('_', $members_id);
        $users = [];
        foreach($members_id as $id) {
            $user = User::find($id);
            if($user) $users[] = $user;
        }

        $result = [
            'data' => $users,
            'total' => $users ? count($users) : 0,
        ];

        return response()->json($result, $users ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'unique_id' => 'required|unique:users,unique_id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // return response()->json($input, $input ? $this->success_status : $this->bas_request);

        $user = User::create($input);
        if($user) $user->assignRole($request->input('roles'));

        return response()->json($user, $user ? $this->success_status : $this->bas_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->roles = $user->roles;
        return response()->json($user, $user ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'name' => 'required',
            // 'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'same:confirm-password',
            // 'roles' => 'required'

            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string|unique:users,username,'.$id,
            'unique_id' => 'required|unique:users,unique_id,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        if ($user) $user->assignRole($request->input('roles'));

        return response()->json($user, $user ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user) $user->delete();
        return response()->json(null, 204);
    }
}
