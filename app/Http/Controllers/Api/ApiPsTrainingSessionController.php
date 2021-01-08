<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsTrainingSession;

class ApiPsTrainingSessionController extends Controller
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
        $ps_training_session = PsTrainingSession::orderBy('id', 'DESC')->paginate(5);
        return response()->json($ps_training_session, $ps_training_session ? $this->success_status : $this->no_data_available_status);
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
            'title' => 'required|string',
            'description' => 'required|string',
            'max_users' => 'required|numeric',
            'level' => 'required|numeric',
            'training_dates' => 'required|json',
            'ps_skill_id' => 'required|numeric',
            'trainer_id' => 'required|numeric',
        ]);

        $input = $request->all();

        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;

        $training_dates = [];
        if (!empty($input['training_dates'])) {
            $training_dates = json_decode($input['training_dates']);
            usort($training_dates, function ($a, $b) {
                return strtotime($a->date) - strtotime($b->date);
            });
            $input['training_dates'] = json_encode($training_dates);
        }


        $ps_training_session = PsTrainingSession::create($input);

        return response()->json($ps_training_session, $ps_training_session ? $this->success_status : $this->bas_request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTrainingSession(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'max_users' => 'required|numeric',
            'level' => 'required|numeric',
            'training_dates' => 'required|json',
            'ps_skill_id' => 'required|numeric',
            'trainer_id' => 'required|numeric',
            'created_by' => 'required|numeric',
            'updated_by' => 'required|numeric',

        ]);

        $input = $request->all();

        $input['title'] = ucfirst(strtolower($input['title']));
        $input['description'] = strtoupper($input['description']);

        $ps_training_session = PsTrainingSession::create($input);

        return response()->json($ps_training_session, $ps_training_session ? $this->success_status : $this->bas_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ps_training_session = PsTrainingSession::find($id);
        //$ps_training_session->wow_categorie = $wow_category->parent_id ? WowCategory::find($wow_category->parent_id) : null;
        return response()->json($ps_training_session, $ps_training_session ? $this->success_status : $this->no_data_available_status);
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
            'title' => 'required|string',
            'description' => 'required|string',
            'max_users' => 'required|string',
            'level' => 'required|numeric',
            'training_dates' => 'required|json',
            'ps_skill_id' => 'required|numeric',
            'trainer_id' => 'required|numeric',
            'created_by' => 'required|numeric',
            'updated_by' => 'required|numeric',

        ]);

        $input = $request->all();

        $input['title'] = ucfirst(strtolower($input['title']));
        $input['description'] = strtoupper($input['description']);

        $ps_training_session = PsTrainingSession::find($id);
        if ($ps_training_session) $ps_training_session->update($input);

        return response()->json($ps_training_session, $ps_training_session ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ps_training_session = PsTrainingSession::find($id);
        if ($ps_training_session) $ps_training_session->delete();
        return response()->json(null, 204);
    }
}
