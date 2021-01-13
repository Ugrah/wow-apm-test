<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JsonForm;

use DB;


class ApiJsonFormController extends Controller
{
    protected $success_status = 200;
    protected $success_create_status = 201;
    protected $bas_request = 400;
    protected $no_data_available_status = 403;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $json_form = JsonForm::find($id);
        return response()->json($json_form, $json_form ? $this->success_status : $this->no_data_available_status);
    }
}
