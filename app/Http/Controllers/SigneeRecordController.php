<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use App\User;
use App\Signature;
use App\PendingSignee;
use App\Contract;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SigneeRecordController extends Controller
{
    private function getRandomHex($num_chars=20) {
        return bin2hex(openssl_random_pseudo_bytes($num_chars/2));
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
        $contract_id = $request->contract_id;
        $usr_email = $request->email;

        //Check whether this user has permission to edit this contract
        if (Contract::find($contract_id)->user_id != Auth::user()->id){
            $errors = array('0' => 'You are not the creator. Get out now to avoid a lawsuit');
            return response()->json(array('errors' => $errors));
        }

        //Check whether user is registered
        if ($signee = User::where('email',$usr_email)->first()) {
            if (Signature::where(['user_id'=>$signee->id,'contract_id'=>$contract_id])->first()) {
                //respond with JSON of user data
                return response()->json(['exists' => 1, 'name' => $signee->f_name.' '.$signee->l_name, 'email' => $usr_email, 'message'=>' is already added to this contract (']);
            }
            else{
                //add record to Signatures
                $signeerecord = new Signature;
                $signeerecord->contract_id = $contract_id;
                $signeerecord->user_id = $signee->id;
                $signeerecord->save();
                //respond with JSON of user data
                return response()->json(['exists' => 1, 'name' => $signee->f_name.' '.$signee->l_name, 'email' => $usr_email, 'message'=>' successfully added to this contract (']);
            }
        }

        //else try to send a message, and add a record to pending users
        else{
            if (PendingSignee::where(['contract_id'=>$contract_id,'email'=>$usr_email])->first()) {
                return response()->json(['exists' => 0, 'email' => $usr_email, 'message'=>'This person has already been added to this contract :']);
            }
            //add a record to pendingsignees
            $emailtoken = $this->getRandomHex();
            $pendingsignee = new PendingSignee;
            $pendingsignee->contract_id = $contract_id;
            $pendingsignee->email = $usr_email;
            $pendingsignee->token = $emailtoken;
            $pendingsignee->save();
            //fetch unsigned signature requests for this email address
            $unsigned_contracts = PendingSignee::where('email',$usr_email);
            //send email
            Mail::send('emails.pendingsignatures', ['unsigned_contracts' => $unsigned_contracts], function ($message) use ($pendingsignee) {
            $message->from('admin@bitsign.it', 'BitSign.it');

            $message->to($pendingsignee->email)->subject('You have been requested to sign a document');
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
