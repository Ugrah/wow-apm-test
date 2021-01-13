<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Terminal;
use App\Models\TerminalEntryPoint;
use DB;
use Hash;
use Illuminate\Support\Arr;

class ApiTerminalController extends Controller
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
        $terminals = Terminal::orderBy('name', 'DESC')->get();
        return response()->json($terminals, $terminals ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $terminals = Terminal::orderBy('id', 'DESC')->paginate(5);
        return response()->json($terminals, $terminals ? $this->success_status : $this->no_data_available_status);
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
            'name' => 'required|string|unique:terminals,name',
            'matricule' => 'required|string',
            'code' => 'required|numeric',
            // 'terminal_entry_point_id' => 'required',
            // 'status' => 'required'
        ]);

        $input = $request->all();

        $input['name'] = ucfirst(strtolower($input['name']));
        $input['matricule'] = strtoupper($input['matricule']);

        $terminal = Terminal::create($input);

        return response()->json($terminal, $terminal ? $this->success_status : $this->bas_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $terminal = Terminal::find($id);
        $terminal->terminal_entry_point = $terminal->terminal_entry_point_id ? TerminalEntryPoint::find($terminal->terminal_entry_point_id) : null;
        return response()->json($terminal, $terminal ? $this->success_status : $this->no_data_available_status);
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
            'name' => 'required|string|unique:terminals,name,'.$id,
            'matricule' => 'required|string',
            'code' => 'required|numeric',
            // 'terminal_entry_point_id' => 'required',
            // 'status' => 'required'
        ]);

        $input = $request->all();

        $input['name'] = ucfirst(strtolower($input['name']));
        $input['matricule'] = strtoupper($input['matricule']);

        $terminal = Terminal::find($id);
        if($terminal) $terminal->update($input);
    
        return response()->json($terminal, $terminal ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terminal = Terminal::find($id);
        if($terminal) $terminal->delete();
        return response()->json(null, 204);
    }
}
