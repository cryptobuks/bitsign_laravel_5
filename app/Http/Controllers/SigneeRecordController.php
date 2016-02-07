<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cache;
use Mail;
use UCrypt;
use App\User;
use App\Signature;
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
    public function create($contract_id)
    {
        $contract = Auth::user()->contracts->find($contract_id);
        if (is_null($contract)) {
            abort(422);
        }
        //takes doc_id and appends to data array, then redirects to file import page
        $data = array(
        'contract_id'  => $contract_id,
        'subheading1'   => 'Contracts',
        'subheading2' => 'Create Contract',
        'subheading3' => 'Add Signees'
        );
        
        if ($sigs = $contract->signatures) {
            foreach ($sigs as $sig) {
                $signee = $sig->signee;
                $data['signeerecords'][] = ['name'=>$signee->f_name.' '.$signee->l_name, 'email'=>$signee->email, 'id' =>$sig->id];
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

        //set data to variables
        $auth_user_id = Auth::user()->id;
        $contract = Contract::with('signatures')->find($request->contract_id);
        //Check whether this user has permission to edit this contract
        if ($contract->creator_id != $auth_user_id){
            abort(422);
        }
        //fetch contract key
        UCrypt::setKey(Cache::get($auth_user_id));
        $contract_key = UCrypt::decrypt($contract->key_enc);
        $usr_email = $request->email;

        //Check whether user with this email exists
        if (is_null($signee = User::where('email',$usr_email)->first())) {
            //register the user
            $signee = User::create(array(
                'email' => $usr_email,
                'registered' =>false
                ));
        }
        elseif($contract->signatures->where('signee_id', $signee->id)->first()){
            return response()->json(['exists' => 2, 'email' => $usr_email]);
        }
        //check if this user is pending
        if ($signee->registered==true) {
            // load the signee pubkey, and encrypt
            $pubkey = openssl_pkey_get_public(file_get_contents(storage_path('keys').'/'.$signee->pubkey.'.pem'));
            openssl_public_encrypt($contract_key, $encryptedcc, $pubkey);
            $encryptedcc = base64_encode($encryptedcc);

            $response = ['exists' => 1, 'name' => $signee->f_name.' '.$signee->l_name, 'email' => $usr_email];
        }
        else{
            $pendingsecret = str_random(32);
            UCrypt::setKey($pendingsecret);
            $encryptedcc = UCrypt::encrypt($contract_key);
            //send email
            Mail::send('emails.pendingsignatures', ['pending_secret' => $pendingsecret, 'user_id'=>$signee->id], function ($message) use ($usr_email) {
            $message->from('admin@bitsign.it', 'BitSign.it');

            $message->to($usr_email)->subject('You have been requested to sign a document');
            });
            //respond with JSON
            $response = ['exists' => 0, 'email' => $usr_email, 'message'=>'An invitation to join Bitsign.it has been sent to '];
        }
        //add record to Signatures
        $signeerecord = new Signature;
        $signeerecord->contract_id = $contract->id;
        $signeerecord->signee_id = $signee->id;
        $signeerecord->contractkey_enc = $encryptedcc;
        $signeerecord->status = false;
        $signeerecord->term = 'default';
        $signeerecord->save();
        //reset contract
        $contract->hash = '';
        $contract->save();
        //respond with JSON of user data
        $response['id']=$signeerecord->id;
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
        //Check whether this contract belongs to this user
        $signeerecord = Signature::with('contract', 'signee')->find($id);

        if ($signeerecord->contract->creator_id != Auth::user()->id){
            $errors[] = 'You are not the creator. Get out now to avoid a lawsuit';
            return array(
                'files' => $files,
                'errors' => $errors
            );
        }
        //if it's a pending user
        $signee = $signeerecord->signee;
        if (!$signee->registered) {
            if ($signee->signatures->count() <= 1) {
                $signee->delete();
            }
        }

        $signeerecord->delete();
        return response()->json(array('deleted' => $id));
    }
}
