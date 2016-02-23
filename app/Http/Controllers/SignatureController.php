<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use JWTAuth;
use App\Signature;
use App\User;
use App\Contract;
use UCrypt;
use Cache;
use XmlDSig;

use Mail;
use App\Packages\Blockcypher;

class SignatureController extends Controller
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
     * Display a listing of the contracts created by the current user
     * GET /signatures
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status)
    {
        $auth_user_id = JWTAuth::parseToken()->authenticate()->id;
        $passphrase = Cache::get($auth_user_id);
        $privkeypath = storage_path('keys/').Cache::get($auth_user_id.'priv').'.pem';
        //get the private key
        $privkeymem = openssl_pkey_get_private(file_get_contents($privkeypath), $passphrase);
        $mysignatures = Signature::with('contract.creator')->where(['signee_id' => $auth_user_id])->get();
        $signatures = array();
        if ($mysignatures instanceof \Illuminate\Database\Eloquent\Collection) {
            foreach ($mysignatures as $signature) {
                //decrypt and assign to $dcrypted_contractkey
                openssl_private_decrypt(base64_decode($signature->contractkey_enc), $dcrypted_contractkey, $privkeymem);
                $contract = $signature->contract;
                $contract_creator = $contract->creator;
                UCrypt::setKey($dcrypted_contractkey);
                $signatures[] = [
                'signature_id' => $signature->id,
                'contract_title'=> Ucrypt::decrypt($contract->title),
                'contract_type' => $contract->contractType->name,
                'contract_creator' =>$contract_creator->f_name.' '.$contract_creator->l_name,
                'contract_created_at' => $contract->created_at
                ];
            }
        }
        //returns the fetched contracts index
        return response()->json($signatures);
    }

    /**
     * Process a request to sign a contract.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function postSign(Request $request)
    {
        $contract = Contract::with('signatures')->find($request->contract_id);
        $user = Auth::user();
        $signeevalidity = $this->isInContract($user->id,$contract);
        if (is_null($user->signkeyname_enc)) {
            return response()->json(['success' => 3, 'message' => 'We don\'t have a valid key file in your name.']);
        }
        if ($signeevalidity==='complete') {
            return response()->json(['success' => 2, 'message' => 'You have already signed this Contract']);
        }
        if ($signeevalidity===true) {
            $this->signIt($user, $contract);
            return response()->json(['success' => 1, 'message' => 'Successfully Signed']);
        }
        else {
            return response()->json(['success' => 0, 'message' => 'You are not in this Contract']);
        }
    }

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
        $auth_user_id = JWTAuth::parseToken()->authenticate()->id;
        $contract = Contract::with('signatures')->find($contract_id);
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
        elseif($signature = $contract->signatures->where('signee_id', $signee->id)->first()){
            return response()->json(['exists' => 2, 'signee' => ['name' => $signee->f_name.' '.$signee->l_name, 'email' => $usr_email, 'id' => $signature->id]]);
        }
        //check if this user is pending
        if ($signee->registered==true) {
            // load the signee pubkey, and encrypt
            $pubkey = openssl_pkey_get_public(file_get_contents(storage_path('keys').'/'.$signee->pubkey.'.pem'));
            openssl_public_encrypt($contract_key, $encryptedcc, $pubkey);
            $encryptedcc = base64_encode($encryptedcc);

            $response = ['exists' => 1, 'signee' => ['name' => $signee->f_name.' '.$signee->l_name, 'email' => $usr_email]];
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
            $response = ['exists' => 0, 'signee' => ['name' => 'Not Registered', 'email' => $usr_email]];
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
        $response['signee']['id']=$signeerecord->id;
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
        // show the details of blockchain record etc
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
        $signeerecord = Signature::with('contract', 'details')->find($id);

        if ($signeerecord->contract->creator_id != JWTAuth::parseToken()->authenticate()->id){
            $errors[] = 'You are not the creator. Get out now to avoid a lawsuit';
            return array(
                'files' => $files,
                'errors' => $errors
            );
        }
        //if it's a pending user
        $signee = $signeerecord->details;
        if (!$signee->registered) {
            if ($signee->signatures->count() <= 1) {
                $signee->delete();
            }
        }

        $signeerecord->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Sign the contract.
     *
     * @param  int  $contract_id
     * @return null
     */
    protected function signIt(User $user, Contract $contract)
    {
        //set XMLDigitalSignature options
        XmlDSig::setCryptoAlgorithm(1);
        XmlDSig::setDigestMethod('sha512');
        XmlDSig::forceStandalone();
        //load the private key
        $privkeypass = Cache::get($user->id);
        $privname = Cache::get($user->id.'priv');
        $pubname = $user->pubkey;
        try
        {
            XmlDSig::loadPrivateKey(storage_path('keys/'.$privname.'.pem'), $privkeypass);
            XmlDSig::loadPublicKey(storage_path('keys/'.$pubname.'.pem'));
            XmlDSig::loadPublicXmlKey(storage_path('keys/'.$pubname.'.xml'));
        }
        catch (\UnexpectedValueException $e)
        {
            print_r($e);
            exit(1);
        }
        //get signature
        $sigrecord = $contract->signatures->where('signee_id',$user->id)->first();

        //load private key to memory
        $privkeymem =  openssl_pkey_get_private(
                file_get_contents(storage_path('keys/').$privname.'.pem'),
                $privkeypass
            );
        //get contract key
        $pubenc_contractkey = $sigrecord->contractkey_enc;
        openssl_private_decrypt(
            base64_decode($pubenc_contractkey),
            $dcrypted_contractkey,
            $privkeymem
        );
        //check document existence
        $filepath = storage_path('contracts/').$contract->id.'/contract.xml';
        if (file_exists($filepath)) {
            //decrypt the contract XML
            $encrypteddata = file_get_contents($filepath);
            UCrypt::setKey($dcrypted_contractkey);
            $decrypteddata = UCrypt::decrypt($encrypteddata);
            $econtract = new \DOMDocument;
            $econtract->loadXML($decrypteddata);
            $signdata = $econtract->getElementsByTagName('contract')[0];
            try{
                XmlDSig::addObject($signdata, 'contractcontent', true);
                XmlDSig::sign();
                XmlDSig::verify();
            }
            catch (\UnexpectedValueException $e){
                print_r($e);
                exit(1);
            }
            //set signature filepath, and write to file
            $sigfpath = storage_path('contracts/'.$contract->id.'/dsig_').$user->f_name.'_'.$user->l_name.'.xml';
            file_put_contents($sigfpath, XmlDSig::getSignedDocument());
            //hash that thang
            $sha256bin = hash('sha256', file_get_contents($sigfpath), true);
            $sha256hex = bin2hex($sha256bin);
            //store in BC
            $blockcypher = new Blockcypher;
            $txhash = $blockcypher->putData($sha256hex);
            //store in DB
            $sigrecord->hash = base64_encode($sha256bin);
            $sigrecord->txhash = $txhash;
            $sigrecord->status = true;
            $sigrecord->save();
        }
    }

    /**
     * Check if this user is in this contract's signature records.
     *
     * @param  int  $user_id
     * @param  int  $contract_id
     * @return boolean or string 'complete'
     */
    protected function isInContract($user_id, Contract $contract)
    {
        if ($signee = $contract->signatures->where('signee_id',$user_id)->first()) {
            if ($signee->status==false) {
                return true;
            }
            return 'complete';
        }
        return false;
    }

}
