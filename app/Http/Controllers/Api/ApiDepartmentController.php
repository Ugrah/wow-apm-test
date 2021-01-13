<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use DB;
use Hash;
use Illuminate\Support\Arr;

class ApiDepartmentController extends Controller
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
        // $this->middleware(['role:ADMIN'], ['except' => ['getAll']]);
    }
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $departments = Department::orderBy('name', 'DESC')->get();
        return response()->json($departments, $departments ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('id', 'DESC')->paginate(5);
        return response()->json($departments, $departments ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string|unique:departments,name',
            'description' => 'required|string',
            'color_code' => 'required|string',
        
        ]);

        $input = $request->all();

        $input['name'] = ucfirst(strtolower($input['name']));
        $input['description'] = strtoupper($input['description']);

        $department = Department::create($input);

        return response()->json($department, $department ? $this->success_status : $this->bas_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        return response()->json($department, $department ? $this->success_status : $this->no_data_available_status);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:departments,name,'.$id,
            'description' => 'required|string',
            'color_code' => 'required|string',
        ]);

        $input = $request->all();

        $input['name'] = ucfirst(strtolower($input['name']));
        $input['description'] = strtoupper($input['description']);

        $department = Department::find($id);
        if($department) $department->update($input);
    
        return response()->json($department, $department ? $this->success_status : $this->no_data_available_status);
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if($department) $department->delete();
        return response()->json(null, 204);
    }
}
