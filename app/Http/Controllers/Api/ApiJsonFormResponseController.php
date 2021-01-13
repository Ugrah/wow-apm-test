<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JsonForm;
use App\Models\JsonFormResponse;

use DB;

class ApiJsonFormResponseController extends Controller
{
    //
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
    public function index(Request $request)
    {
        $json_form_responses = JsonFormResponse::where('user_id', $request->user()->id)->orderBy('id', 'DESC')->paginate(5);
        foreach($json_form_responses as &$form_response) {
            $form_response->json_form = JsonForm::find($form_response->json_form_id);
        }
        return response()->json($json_form_responses, $json_form_responses ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kaizenIndex(Request $request)
    {
        // Param must be inside config file
        $kaizen_form_id = 2;

        $json_form_responses = JsonFormResponse::where([
            'json_form_id' => $kaizen_form_id,
            'user_id' => $request->user()->id
        ])->orderBy('id', 'DESC')->paginate(5);
        foreach($json_form_responses as &$form_response) {
            $form_response->json_form = JsonForm::find($form_response->json_form_id);
        }
        return response()->json($json_form_responses, $json_form_responses ? $this->success_status : $this->no_data_available_status);
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
            'data' => 'required|json',
            'json_form_id' => 'required|numeric',
        ]);

        $input = $request->all();
        $input['user_id'] = $request->user()->id;

        // return response()->json($input, $input ? $this->success_status : $this->bas_request);

        $json_form_response = JsonFormResponse::create($input);

        return response()->json($json_form_response, $json_form_response ? $this->success_status : $this->bas_request);
    }
}
