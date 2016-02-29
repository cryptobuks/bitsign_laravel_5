<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EditorPermission;
use App\Contract;
use JWTAuth;
use Cache;
use UCrypt;
use App\User;
use Log;

class EditorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contract_id)
    {
        $auth_user_id = JWTAuth::parseToken()->authenticate()->id;
        $contract = Contract::with('contractType', 'editors.details')->find($contract_id);
        if ($contract->creator_id != $auth_user_id) {
            abort(422);
        }
        foreach ($contract->editors as $key => $editor) {
            $editors[$key] = $editor->details;
            $editors[$key]->id = $editor->id;
        }
        if (isset($editors)) {
            return response()->json(['hasrecords' => true, 'editors'=>$editors]);
        }
        else return response()->json(['hasrecords' => false]);
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $contract_id)
    {
        //Validate that it's an email adress
        $this->validate($request,array(
            'email' => 'required|email'
            ));

        //set data to variables
        $auth_user = JWTAuth::parseToken()->authenticate();
        $contract = Contract::with('editors')->find($contract_id);
        //Check whether this user has permission to edit this contract
        if ($contract->creator_id != $auth_user->id){
            abort(422);
        }
        //fetch contract key
        UCrypt::setKey(Cache::get($auth_user->id));
        $contract_key = UCrypt::decrypt($contract->key_enc);
        $usr_email = $request->email;

        //Check whether user with this email exists
        if (is_null($editor = User::where('email',$usr_email)->first())) {
            //register the user
            $editor = User::create(array(
                'email' => $usr_email,
                'registered' =>false
                ));
        }
        if($contract->editors->where('editor_id', $editor->id)->first()){
            return response()->json(['sharestatus' => 2]);
        }
        //check if this user is pending
        if ($editor->registered==true) {
            // load the editor pubkey, and encrypt
            $pubkey = openssl_pkey_get_public(file_get_contents(storage_path('keys').'/'.$editor->pubkey.'.pem'));
            openssl_public_encrypt($contract_key, $encryptedcc, $pubkey);
            $encryptedcc = base64_encode($encryptedcc);

            $response = ['sharestatus' => 1, 'editor' => $editor];
        }
        else{
            $pendingsecret = str_random(32);
            UCrypt::setKey($pendingsecret);
            $encryptedcc = UCrypt::encrypt($contract_key);
            $creator_name = $auth_user->f_name.' '.$auth_user->l_name;
            //send email
            Mail::send('emails.pendingsignatures', ['pending_secret' => $pendingsecret, 'user_id'=>$editor->id], function ($message) use ($usr_email, $creator_name) {
            $message->from('admin@bitsign.it', 'BitSign.it');

            $message->to($usr_email)->subject($creator_name.' has asked you to collaborate on an eContract');
            });
            //respond with JSON
            $response = ['sharestatus' => 0, 'editor' => ['f_name' => 'Not','l_name' => 'Registered', 'email' => $usr_email]];
        }
        //add record to Signatures
        $editorrecord = new EditorPermission;
        $editorrecord->contract_id = $contract->id;
        $editorrecord->editor_id = $editor->id;
        $editorrecord->contractkey_enc = $encryptedcc;
        $editorrecord->save();
        //reset contract
        $contract->hash = '';
        $contract->save();
        //respond with JSON of user data
        $response['editor']['id']=$editorrecord->id;
        return response()->json($response);
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
        $auth_user_id = JWTAuth::parseToken()->authenticate()->id;
        Log::warning('attemting to delete id: '.$id);
        $editor = EditorPermission::with('contract')->find($id);
        $contract = $editor->contract;
        if ($contract->creator_id != $auth_user_id) {
            abort(422);
        }
        else{
            $editor->delete();
            return response()->json(['success'=>true]);
        }
    }
}
