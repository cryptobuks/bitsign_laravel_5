<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\EditorPermission;
use App\ContractType;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Cache;
use UCrypt;

class ContractController extends Controller
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
	 * GET /contracts
	 *
	 * @return Response
	 */
	public function index()
	{
        $auth_user_id = JWTAuth::parseToken()->authenticate()->id;
		$contracts = array();
		$secret = Cache::get($auth_user_id);
        $criteria = ['creator_id'=>$auth_user_id];
		foreach (Contract::where($criteria)->get() as $key => $contract) {
			UCrypt::setKey($secret);
			UCrypt::setKey(Ucrypt::decrypt($contract->key_enc));
			$contracts[] = [
			'id' => $contract->id,
			'title'=> $contract->title,
			'type' => 'default',
			'created_at' => $contract->created_at
			];
		}
        $editorpermissions = EditorPermission::with('contract')->where(['editor_id' => $auth_user_id, 'accepted' => true]);
        foreach ( $editorpermissions as $ep) {
            $contract = $ep->contract;
            $contracts[] = [
            'id' => $contract->id,
            'title'=> $contract->title,
            'type' => 'default',
            'created_at' => $contract->created_at
            ]; 
        }
		//returns the fetched contracts index
		return response()->json($contracts);
	}

	/**
	 * Return the form for updating the resource.
	 * GET /contracts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//contract data
		$contractraw = JWTAuth::parseToken()->authenticate()->contracts->find($id);
		if (is_null($contractraw)){
			abort(422);
		}
		Ucrypt::setKey(Cache::get($contractraw->creator_id));
		Ucrypt::setKey(Ucrypt::decrypt($contractraw->key_enc));

		$contract = [
        'id' => $contractraw->id,
        'title' => $contractraw->title,
        'clauses' => UCrypt::decrypt($contractraw->clauses),
        'terms' => UCrypt::decrypt($contractraw->terms),
        'parties' => UCrypt::decrypt($contractraw->parties),
        'attachments' => UCrypt::decrypt($contractraw->attachments),
        ];
        return response()->json($contract);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /contracts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	
	public function store(Request $request)
	{
        // set creator id
        $creator_id = JWTAuth::parseToken()->authenticate()->id;

        //validate

        //if contract exists
        if (!isset($request->id) || $request->id=='new') {
            // generate this contract's key
            $contract_key = str_random(32);
            //encrypt contract key
            UCrypt::setKey(Cache::get($creator_id));
            $contractkey_enc = UCrypt::encrypt($contract_key);
            //encrypt contract title and content with contract key
            UCrypt::setKey($contract_key);
            $contract = new Contract;
            $contract->key_enc = $contractkey_enc;
        }

        else {
            $contract = JWTAuth::parseToken()->authenticate()->contracts->find($request->id);
            //save the encrypted stuff
            UCrypt::setKey(Cache::get($contract->creator_id));
            UCrypt::setKey(UCrypt::decrypt($contract->key_enc));
        }

        // store in database
        $contract->title = $request->title;
        $contract->clauses = UCrypt::encrypt($request->clauses);
        $contract->terms = UCrypt::encrypt($request->terms);
        $contract->parties = UCrypt::encrypt($request->parties);
        $contract->attachments = UCrypt::encrypt($request->attachments);
        $contract->creator_id = $creator_id;
        $contract->save();
 
        $response = array(
            'success' => 'true',
            'contract_id' => $contract->id
        );
 
        return response()->json( $response );
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
			//if increasing the max size, also increase database
        'title' => 'required|max:40',
        'content' => 'required'
    	]);

		// get input
        $contract = JWTAuth::parseToken()->authenticate()->contracts->find($id);
        $contract_title = $request->title;
        $contract_content = $request->content;
        
        if (is_null($contract)) {
        	abort(422);
        }
        //save the encrypted stuff
        UCrypt::setKey(Cache::get($contract->creator_id));
        UCrypt::setKey(UCrypt::decrypt($contract->key_enc));
        if ($contract->title != $contract_title || UCrypt::decrypt($contract->content) != $contract_content) {
        	$contract->title = $contract_title;
	        $contract->content = UCrypt::encrypt($contract_content);
	        $contract->hash = '';
	        $contract->save();
        }

        $response = array(
            'success' => 'true',
            'contract_id' => $id
        );
 
        return response()->json( $response );
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /contracts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * Index the signees of this contract.
     * GET /contract/{id}/signees
     *
     * @param  int  $id
     * @return Response
     */
    public function signees($contract_id)
    {
        $auth_user_id = JWTAuth::parseToken()->authenticate()->id;
        $contract = Contract::with('signatures.details')->find($contract_id);
        $signees =[];
        foreach ($contract->signatures as $signature) {
            $signee = $signature->details;
            $signees[] = ['name' => $signee->f_name.' '.$signee->l_name, 'email' => $signee->email,'id' =>$signature->id];
        }

        return response()->json($signees);
    }

	/**
     * Fetch contract data from database.
     *
     * @return string $contract_data
     */
    protected function getContractData($contract_id)
    {
        $auth_user_id = JWTAuth::parseToken()->authenticate()->id;
        $contract = Contract::with('signatures.details.address','filerecords', 'contractType')->find($contract_id);
        //set filepath
        $filepath = storage_path('contracts/').$contract->id.'/contract.xml';
        //get the contract decryption key
        if ($contract->creator_id != $auth_user_id) {
            $pkeyname = Cache::get($auth_user_id.'priv').'.pem';
            $pubenc_contractkey = $contract->signatures->where('signee_id',$auth_user_id)->first()->contractkey_enc;
            openssl_private_decrypt(
                base64_decode($pubenc_contractkey),
                $dcrypted_contractkey,
                openssl_pkey_get_private(
                    file_get_contents(storage_path('keys').'/'.$pkeyname),
                    Cache::get($auth_user_id)
                )
            );
        }
        else {
            UCrypt::setKey(Cache::get($auth_user_id));
            $dcrypted_contractkey = UCrypt::decrypt($contract->key_enc);
        }
        //set the contract data key
        UCrypt::setKey($dcrypted_contractkey);
        //get data and fill in array
        $data['id'] = $contract->id;
        $data['title'] = $contract->title;
        $data['body'] = UCrypt::decrypt($contract->content);
        $data['contract_type'] = str_replace(' ', '_', strtolower($contract->contractType->name));
        $data['key'] = $dcrypted_contractkey;
        //arrange the signing individuals into parties and fill in $data
        foreach ($contract->signatures as $signature) {
            $signee = $signature->details;
            $saddress = $signee->address;
            $addressstring = $saddress->line_1.', '.$saddress->line_2.', '.$saddress->city.', '.$saddress->state.' '.$saddress->postalcode.', '.$saddress->country;
            $data['parties'][$signature->term][] = [$signee->f_name.' '.$signee->l_name, $addressstring];
        }
        //arrange the filerecord necessary into data
        foreach ($contract->filerecords as $key=>$filerecord) {
            $data['filerecords'][$key] = [
                'hash'=>$filerecord->hash,
                'filename'=>$filerecord->filename,
                'type'=>$filerecord->type
            ];
            # code...
        }
        //build doc if legalXML not built
        if (strlen($contract->hash)==0 || !file_exists($filepath)) {
            $buildreturn = $this->assembleDoc($data, $filepath);
            $contract->hash = $buildreturn[0];
            $data['date'] = $buildreturn[1];
            $contract->save();
        }
        else{
            UCrypt::setKey($dcrypted_contractkey);
            $decryptedfile = UCrypt::decrypt(file_get_contents($filepath));
            //get date
            $contractdoc = new \DOMDocument;
            $contractdoc->loadXML($decryptedfile);
            $data['date'] = $contractdoc->getElementsByTagName('date')[0]->nodeValue;
        }
        //set key
        UCrypt::setKey($dcrypted_contractkey);
        //get encrypted data
        $encrypteddata = file_get_contents($filepath);
        //decrypt
        $filedata = UCrypt::decrypt($encrypteddata);
        //check hash and return
        if (base64_encode(hash('sha384',$filedata,true))==$contract->hash) {
            $data['hash'] = $contract->hash; 
        }
        else{
            abort(422);
        }
        return $data;
    }

    /**
     * Assemble the XML from everything.
     *
     * @return string $contracthash
     */
    protected function assembleDoc($data, $filepath)
    {
        //load xml from template
        $doc = new \DOMDocument;
        $doc->load(base_path('resources/xmltemplates/').$data['contract_type'].'.xml');
        //set title
        $doc_title = $doc->getElementById('title');
        $doc_title->nodeValue = $data['title'];
        //set date
        $doc_date = $doc->getElementsByTagName('date')[0];
        $contractdate = date(DATE_RFC2822);
        $doc_date->nodeValue = $contractdate;
        //set parties
        $partiesnode = $doc->getElementsByTagName('parties')[0];
        foreach ($data['parties'] as $party => $personrecords) {
            $partynode = $partiesnode->appendChild($doc->createElement("party"));
            $firstpass = true;
            foreach ($personrecords as $personrecord) {
                if ($firstpass) {
                    $firstpass = false;
                }
                else{
                    $partynode->appendChild($doc->createTextNode("and"));
                }
                $prnode = $partynode->appendChild($doc->createElement("person-record"));
                $prnode->appendChild($doc->createElement("name",$personrecord[0]));
                $prnode->appendChild($doc->createTextNode("of"));
                $prnode->appendChild($doc->createElement("address",$personrecord[1]));
            }
            if (count($personrecords) == 1) {
                $partynode->appendChild($doc->createTextNode(', hereafter referred to as "'));
            }
            else{
                $partynode->appendChild($doc->createTextNode(', hereafter collectively referred to as "'));
            }
            $partynode->appendChild($doc->createElement("term", $party));
            $partynode->appendChild($doc->createTextNode('"'));
        }
        //write content
        $newnode = $doc->createDocumentFragment();
        $newnode->appendXML(str_replace('&nbsp;', '&#xA0;', $data['body']));
        $doc->getElementById('contract-content')->appendChild($newnode);
        //write filerecords
        $attachmentsnode = $doc->getElementsByTagName('attachments')[0];
        if (isset($data['filerecords'])) {
            foreach ($data['filerecords'] as $filerecord) {
                $attachmentnode = $attachmentsnode->appendChild($doc->createElement('attachment'));
                $objectnode = $attachmentnode->appendChild($doc->createElement('object'));
                $objectnode->setAttribute("type", $filerecord['type']);
                $datanode = $objectnode->appendChild($doc->createElement('data'));
                $datanode->setAttribute("src", $filerecord['filename']);
                $hashnode = $objectnode->appendChild($doc->createElement('hash', $filerecord['hash']));
                $hashnode->setAttribute("algorithm", "sha384");
            }
        }
        //save the file
        $doc->save($filepath);
        //get the hash of it
        $contracthash = base64_encode(hash_file('sha384', $filepath, true));
        //encrypt the document
        $unencryptedfile = file_get_contents($filepath);
        UCrypt::setKey($data['key']);
        file_put_contents($filepath, UCrypt::encrypt($unencryptedfile));
        //return the contract data
        return array($contracthash,$contractdate);
    }
}
