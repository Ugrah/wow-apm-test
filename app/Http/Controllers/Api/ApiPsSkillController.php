<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsSkill;
use App\Models\WowCategory;

use DB;
use Hash;
use Illuminate\Support\Arr;

class ApiPsSkillController extends Controller
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
        $ps_skills = PsSkill::orderBy('id', 'DESC')->paginate(5);
        return response()->json($ps_skills, $ps_skills ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Display a listing of the resource from parent category.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPsSkillsFromCategory($category_id)
    {
        $ps_skills = PsSkill::where('wow_category_id', $category_id)->get();
        return response()->json($ps_skills, $ps_skills ? $this->success_status : $this->no_data_available_status);
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
            'skill_name' => 'required|string|unique:departments,name',
            'url_link' => 'required|string',
            'wow_category_id' => 'numeric'
            // 'logo_filename' => 'required|string',
        ]);

        $input = $request->all();

        // $input['skill_name'] = ucfirst(strtolower($input['skill_name']));
        $input['url_link'] = strtoupper($input['url_link']);
        $input['created_by'] = $request->user()->id;

        $input['logo_filename'] = empty($input['logo_filename']) ? '' : '';

        $ps_skill = PsSkill::create($input);

        return response()->json($ps_skill, $ps_skill ? $this->success_status : $this->bas_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ps_skill = PsSkill::find($id);
        // $ps_skill->wow_categorie = $ps_skill->wow_category_id ? WowCategory::find($ps_skill->wow_category_id) : null;
        return response()->json($ps_skill, $ps_skill ? $this->success_status : $this->no_data_available_status);
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
            'skill_name' => 'required|string|unique:terminals,name,' . $id,
            'url_link' => 'required|string',
            // 'logo_filename' => 'required|string',
            // 'created_by' => 'required|string',
            'wow_category_id' => 'numeric'
        ]);

        $input = $request->all();

        // $input['skill_name'] = ucfirst(strtolower($input['skill_name']));
        $input['url_link'] = strtoupper($input['url_link']);
        $input['created_by'] = $request->user()->id;

        $input['logo_filename'] = empty($input['logo_filename']) ? '' : '';

        $ps_skill = PsSkill::find($id);
        if ($ps_skill) $ps_skill->update($input);

        return response()->json($ps_skill, $ps_skill ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Get experts from skill_id
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getExperts(Request $request, $id)
    {
        $expert_level = 5;
        $experts = DB::table('ps_training_sessions')
            ->join('ps_training_session_user', 'ps_training_sessions.id', '=', 'ps_training_session_user.training_session_id')
            ->join('users', 'ps_training_session_user.user_id', '=', 'users.id')
            ->select(
                'ps_training_sessions.id',
                'ps_training_sessions.title',
                'ps_training_sessions.description',
                'ps_training_sessions.max_users',
                'ps_training_sessions.ps_skill_id',
                'ps_training_sessions.level',
                'ps_training_sessions.trainer_id',
                'user_id',
                'users.firstname',
                'users.lastname',
            )
            ->where('ps_training_sessions.ps_skill_id', $id)
            ->where('ps_training_sessions.level', '>=', $expert_level)
            ->where('ps_training_session_user.acquired', 1)
            ->orderBy('id', 'DESC')->paginate(5);

        return response()->json($experts, $experts ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ps_skill = PsSkill::find($id);
        if ($ps_skill) $ps_skill->delete();
        return response()->json(null, 204);
    }
}
