<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsTrainingSessionUser;

class ApiPsTrainingSessionUserController extends Controller
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
        $this->middleware(['role:admin'], ['except' => ['getAll']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ps_training_session_user = PsTrainingSessionUser::orderBy('id', 'DESC')->paginate(5);
        return response()->json($ps_training_session_user, $ps_training_session_user ? $this->success_status : $this->no_data_available_status);
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
            'training_session_id' => 'required|string|unique:ps_training_session_users,training_session_id',
            'user_id' => 'required|numeric',
            'registred_for_training' => 'required|numeric',
            'registred_for_training_at' => 'required|time',
            'acquired' => 'required|numeric',
            'acquired_at' => 'required|numeric',
        ]);

        $input = $request->all();

        $input['training_session_id'] = ucfirst(strtolower($input['training_session_id']));
        $ps_training_session_user = PsTrainingSessionUser::create($input);

        return response()->json($ps_training_session_user, $ps_training_session_user ? $this->success_status : $this->bas_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $ps_training_session_user = PsTrainingSessionUser::find($id);
        //   $ps_training_session_user->wow_categorie = $wow_category->parent_id ? WowCategory::find($wow_category->parent_id) : null;
        return response()->json($ps_training_session_user, $ps_training_session_user ? $this->success_status : $this->no_data_available_status);
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
            'training_session_id' => 'required|string|unique:ps_training_session_users,training_session_id',
            'user_id' => 'required|numeric',
            'registred_for_training' => 'required|numeric',
            'registred_for_training_at' => 'required|time',
            'acquired' => 'required|numeric',
            'acquired_at' => 'required|numeric',

        ]);

        $input = $request->all();

        // $input['training_session_id'] = ucfirst(strtolower($input['training_session_id']));
        // $input['url_link'] = strtoupper($input['url_link']);

        $ps_training_session_user = PsTrainingSessionUser::find($id);
        if ($ps_training_session_user) $ps_training_session_user->update($input);

        return response()->json($ps_training_session_user, $ps_training_session_user ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ps_training_session_user = PsTrainingSessionUser::find($id);
        if ($ps_training_session_user) $ps_training_session_user->delete();
        return response()->json(null, 204);
    }
}
