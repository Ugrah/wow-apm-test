<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsTrainingSession;
use DB;

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
        // $this->middleware(['role:ADMIN'], ['except' => []]);
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
     * Get Training sessions by year.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function getPsTrainingSessionsByYear($year)
    {
        $number_of_weeks = $this->getIsoWeeksInYear($year);

        $first_date = $this->getStartAndEndDate(1, $year)['week_start'];
        $last_date = $this->getStartAndEndDate($number_of_weeks, $year)['week_end'];

        $having = "DATE(STR_TO_DATE(`first_date`, '%d-%m-%Y')) >= '$first_date' AND DATE(STR_TO_DATE(`first_date`, '%d-%m-%Y')) <= '$last_date'";

        $ps_training_sessions = DB::table('ps_training_sessions')
            ->join('ps_skills', 'ps_training_sessions.ps_skill_id', '=', 'ps_skills.id')
            ->join('users', 'ps_training_sessions.trainer_id', '=', 'users.id')
            ->join('wow_categories', 'ps_skills.wow_category_id', '=', 'wow_categories.id')
            ->select(
                'ps_training_sessions.*',
                'ps_skills.skill_name',
                'wow_categories.name as category_name',
                'users.firstname as trainer_firstname',
                'users.lastname as trainer_lastname',
                DB::raw('JSON_UNQUOTE(JSON_EXTRACT(ps_training_sessions.training_dates, \'$[0].date\')) as first_date'),
            )
            ->orderBy('id', 'DESC')
            ->havingRaw($having)
            ->get();

        foreach ($ps_training_sessions as &$ps_training_session) {
            $members_query = DB::table('ps_training_session_user')->select('user_id')->where('training_session_id', $ps_training_session->id);

            $ps_training_session->countUsers = $members_query->where('registered_for_training', '>', 10)->count();

            $ps_training_session->members = $members_query->where('registered_for_training', '>', 10)->pluck('user_id');

            $ps_training_session->validate_members = $members_query->where('registered_for_training', 30)->pluck('user_id');

            $ps_training_session->skill_approved_members = $members_query->where(['registered_for_training' => 30, 'acquired' => 1])->pluck('user_id');

            $ps_training_session->waiting_members = $members_query->where('registered_for_training', 10)->pluck('user_id');
            
            $ps_training_session->reject_members = $members_query->where('registered_for_training', '<=', 0)->pluck('user_id');

            $ps_training_session->weeknumber = (int) $this->getWeekNumber($ps_training_session->first_date);

        }

        $result = [
            'year' => (int) $year,
            'number_of_weeks' => $number_of_weeks,
            'data' => $ps_training_sessions ?? [],
            'total' => count($ps_training_sessions),
        ];
        return response()->json($result, $ps_training_sessions ? $this->success_status : $this->no_data_available_status);
    }

    private function getIsoWeeksInYear($year)
    {
        $date = new \DateTime;
        $date->setISODate($year, 53);
        return ($date->format("W") === "53" ? 53 : 52);
    }

    private function getStartAndEndDate($week, $year, $format = 'Y-m-d')
    {
        $dto = new \DateTime();
        $ret['week_start'] = $dto->setISODate($year, $week)->format($format);
        $ret['week_end'] = $dto->modify('+6 days')->format($format);
        return $ret;
    }

    private function getWeekNumber($ddate)
    {
        $date = new \DateTime($ddate);
        $week = $date->format("W");
        return $week;
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
