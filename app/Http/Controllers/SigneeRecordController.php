<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cache;
use Mail;
use App\User;
use App\Signature;
use App\PendingSigrequest;
use App\PendingUser;
use App\Contract;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SigneeRecordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //takes doc_id and appends to data array, then redirects to file import page

        $data = array(
        'contract_id'  => $id,
        'subheading1'   => 'Contracts',
        'subheading2' => 'Create Contract',
        'subheading3' => 'Add Signees'
        );

        if ($sigs = Contract::find($id)->signatures) {
            foreach ($sigs as $sig) {
                $signee = $sig->user;
                $data['signeerecords'][] = ['name'=>$signee->f_name.' '.$signee->l_name, 'email'=>$signee->email];
            }
        }

        //returns an uploader page
        return view('signeerecord.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate that it's an email adress
        $this->validate($request,array(
            'contract_id' => 'required',
            'email' => 'required|email'
            ));

        //set data to variable
        $contract = Contract::find($request->contract_id);
        //fetch contract key
        $auth_user = Auth::user();
        $contract->setSecret(Cache::get($auth_user->id));
        $contract_key = $contract->key;
        $usr_email = $request->email;

        //Check whether this user has permission to edit this contract
        if ($contract->user_id != $auth_user->id){
            abort(422);
        }

        //Check whether user is registered
        if ($signee = User::where('email',$usr_email)->first()) {
            if (Signature::where(['user_id'=>$signee->id,'contract_id'=>$contract->id])->first()) {
                //respond with JSON of user data
                return response()->json(['exists' => 1, 'name' => $signee->f_name.' '.$signee->l_name, 'email' => $usr_email, 'message'=>' is already added to this contract (']);
            }
            else{
                // load the signee pubkey, and encrypt
                $pubkey = openssl_pkey_get_public(file_get_contents(storage_path('keys').'/'.$signee->pubkey.'.pem'));
                openssl_public_encrypt($contract_key, $encryptedcc, $pubkey);
                //add record to Signatures
                $signeerecord = new Signature;
                $signeerecord->contract_id = $contract->id;
                $signeerecord->user_id = $signee->id;
                $signeerecord->contractkey_enc = base64_encode($encryptedcc);
                $signeerecord->status = 0;
                $signeerecord->term = 'default';
                $signeerecord->save();
                //respond with JSON of user data
                return response()->json(['exists' => 1, 'name' => $signee->f_name.' '.$signee->l_name, 'email' => $usr_email, 'message'=>' successfully added to this contract (']);
            }
        }

        //else try to send a message, and add a record to pending users
        else{
            //add a record to pending users if not exists
            $pendinguser = PendingUser::where('email', $usr_email)->first();
            if ($pendinguser==null) {
                $token = str_random(20);
                $pendinguser = PendingUser::create(array(
                    'email' => $usr_email,
                    'token' => $token
                    ));
            }
            else {
                $token = $pendinguser->token;
            }
            //check if pending user is already added to contract
            if (PendingSigrequest::where(['contract_id'=>$contract->id,'pending_user_id'=>$pendinguser->id])->first()) {
                return response()->json(['exists' => 0, 'email' => $usr_email, 'message'=>'This person has already been added to this contract :']);
            }
            //add a record to pending sigrequsts
            $pendingsigrequest = PendingSigrequest::create(array(
                'contract_id' => $contract->id,
                'pending_user_id' => $pendinguser->id
                ));
            $pendingsecret = str_random(32);
            $pendingsigrequest->setSecret(hash('sha256', $token.$pendingsecret, true));
            $pendingsigrequest->key_enc = $contract_key;
            $pendingsigrequest->save();
            //fetch unsigned signature requests for this email address
            $unsigned_contracts = PendingSigrequest::where('pending_user_id',$pendinguser->id);
            //send email
            Mail::send('emails.pendingsignatures', ['unsigned_contracts' => $unsigned_contracts, 'pending_secret' => $pendingsecret, 'user_id'=>$pendinguser->id], function ($message) use ($usr_email) {
            $message->from('admin@bitsign.it', 'BitSign.it');

            $message->to($usr_email)->subject('You have been requested to sign a document');
            });
            //respond with JSON
            return response()->json(['exists' => 0, 'email' => $usr_email, 'message'=>'An invitation to join Bitsign.it has been sent to ']);
        }

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
