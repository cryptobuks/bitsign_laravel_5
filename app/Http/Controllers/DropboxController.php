<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use GuzzleHttp\Client;

class DropboxController extends Controller
{
    /**
     * Guzzle Http Client
     */
    protected $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('jwt.auth');
        $this->client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.dropboxapi.com/1/'
        ]);
    }
    
    /**
     * get token from OAUTH2.
     *
     * @param $code
     * @return $token
     */
    protected function getToken($code){
        $uri = 'oauth2/token';
        $query = [
            
        ];
        $data = [
            'code'=>$code,
            'grant_type'=>'authorization_code',
            'client_id'=> config('services.dropbox.key'),
            'client_secret'=> config('services.dropbox.secret'),
            'redirect_uri'=>config('services.dropbox.redirect')
            ];
        $response = $this->client->request('POST', $uri, ['form_params'=>$data]);
        return json_decode($response->getBody(), true)['access_token'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function persistToken(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $code = $request->code;
        
        $token = $this->getToken($code);
        $user->dropbox_token = $token;
        $user->save();
        return response()->json($user);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
