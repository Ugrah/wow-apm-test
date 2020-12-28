<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

use App\Services\ApiService;
use Illuminate\Support\Facades\URL;
use Cookie;

class UserMainController extends Controller
{
    //
    protected $_config;
    protected $api_service;

    public $success_status = 200;


    public function __construct(ApiService $api_service)
    // public function __construct()
    {
        $this->_config = request('_config');
        $this->api_service = $api_service;
        $this->middleware('auth.user')->only(['userType']);
    }

    /** 
     * login 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function login()
    {
        Cookie::queue(Cookie::forget('api_token'));
        return view($this->_config['view']);
    }

    /** 
     * signin 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function signin(Request $request)
    {

        $body = null;
        $cookie = null;

        $data = ['email' => $request->input('login'), 'password' => $request->input('password')];
        // $client = new \GuzzleHttp\Client(['base_uri' => env('API_BASE_URL')]);

        try {
            // $res = $client->request('POST', '/api/login', ['form_params' => $data]);
            $res = $this->api_service->signin($data);
            $body = json_decode($res->getBody());
        } catch (\Exception $e) {
            // $responseBody = $e->getResponse()->getBody(true);
        }
        if (!empty($body->success->token)) {
            $minutes = 60;
            // $cookie = cookie('api_token', $body->success->token, $minutes);
            $cookie = cookie('api_token', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNjgyZmUxNDNkMTFiMTcwN2M5YTUzMjk2Mjk3ZTI3ZjEwYzQxMjI0ZGRmMmM1YTBiODAzNGU1ZTc0ZmYwMzUyZmY5YjZiMmYyZGQ1N2EwODEiLCJpYXQiOjE2MDkxNzAyNzcsIm5iZiI6MTYwOTE3MDI3NywiZXhwIjoxNjExODQ4Njc3LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.L63alXOKLzZeqNx3ZEfgy-FTwg5ZyP59D7RZG4IdnjFfh3jNTJagcmIk1j8rkhWhvoWtlXqjer7Wg4qVIcYlnwQPqnMmZKeMMSklOC8Ur2SdTUIOuV2eRgZSEPK-mwSpLQYmAroJhF_qz-M1R1YuUNgboBR6l2rtVNL4BnRR8ZXo62G-KkRlzuZRmVILeIBHWb86jqkIoctTHJaprZGCauxgH8Vo_aDP61GaMROcRSgo--uOrAcUcF1E_WGaeZVg9-w5vkol-_NCMDoblIrKBNpKZrO7t1rrQ-VaTUn9KiSA_46NbP4PRjQkH6wz27kjZNcNk9IBpUGPUbtBdFop0S_OY3UsIuX7le4GPs_ehB8LFjAXZg3G1_5tTa7SBgOFQ18NhDtNJbkE-svY_UeB5lry4qxosYJYhGvB5Db9WayK06ICMaBqIbNyiCJj8vbZ4YVzh7ur1gXDohjHdICSnQMwuP6IZ498y7gbZEqaDc6z8Z6DlqFnsrnFFk2ZEhWYK4sqmU_DsxZr4jd6cFfADWCCHzD9W3mGUBxhKq-drnmT5ij0YpB3pdAwB7w8ty9xx4cZ64h1UxBAxS7lgD1wNLRK42zP7ddiFfYyghwCNs-WC_Rokdl2up1ntifz6wsd1KgmKXxtdUpiIK0aoykmKyci5GO4GtHxIR8palnM43M', $minutes);
        } else {
            Cookie::queue(Cookie::forget('api_token'));
        }

        // echo '<pre>',print_r($body,1),'</pre>'; exit();
        $result = !empty($body->success->token) ?
            [
                'status' => $res->getStatusCode(),
                'content' => $res->getHeaderLine('content-type'),
                'result' => $body,
                'redirectUrl' => route($this->_config['redirect'])
            ] : [
                'status' => 401,
                'content' => null,
                'result' => null,
            ];
        return response()->json($result, $result['status'])->cookie($cookie);
    }

    /** 
     * User Type 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function userType(Request $request)
    {
        $api_token = $request->input('api_token');
        if($api_token) session()->put('api_token', $api_token);

        return view($this->_config['view']);
    }

    /**
     * Destroy session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     auth()->guard('user')->logout();

    //     return redirect()->route($this->_config['redirect']);
    // }
}
