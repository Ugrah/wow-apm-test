<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WowCategory;

class ApiWowCategoryController extends Controller
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
        $wow_category = WowCategory::orderBy('id', 'DESC')->paginate(5);
        return response()->json($wow_category, $wow_category ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Display menu categories
     *
     * @return \Illuminate\Http\Response
     */
    public function sideMenuCategories()
    {
        $wow_category = WowCategory::where('parent_id', null)->get();
        return response()->json($wow_category, $wow_category ? $this->success_status : $this->no_data_available_status);
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
            'name' => 'required|string',
            'url_link' => 'required|string',
            // 'logo_filename' => 'required|string',
            'parent_id' => 'numeric',

        ]);

        $input = $request->all();

        // $input['name'] = ucfirst(strtolower($input['name']));
        $input['logo_filename'] = '';

        $wow_category = WowCategory::create($input);

        return response()->json($wow_category, $wow_category ? $this->success_status : $this->bas_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wow_category = WowCategory::find($id);
        $wow_category->children = WowCategory::where('parent_id', $id)->get();
        return response()->json($wow_category, $wow_category ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFromName($name)
    {
        $wow_category = WowCategory::where('name', 'like', '%' . $name . '%')->first();
        $wow_category->children = WowCategory::where('parent_id', $wow_category->id)->get();
        return response()->json($wow_category, $wow_category ? $this->success_status : $this->no_data_available_status);
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
            'name' => 'required|string',
            'url_link' => 'required|string',
            'logo_filename' => 'required|string',
            'parent_id' => 'required|numeric',

        ]);

        $input = $request->all();

        $input['name'] = ucfirst(strtolower($input['name']));
        $input['url_link'] = strtoupper($input['url_link']);

        $wow_category = WowCategory::find($id);
        if ($wow_category) $wow_category->update($input);

        return response()->json($wow_category, $wow_category ? $this->success_status : $this->no_data_available_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wow_category = WowCategory::find($id);
        if ($wow_category) $wow_category->delete();
        return response()->json(null, 204);
    }
}
