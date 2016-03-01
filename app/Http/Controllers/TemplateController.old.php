<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use App\EditorPermision;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Cache;
use UCrypt;

class TemplateController extends Controller
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
		$documents = array();
		$auth_user_id = Auth::user()->id;
		foreach (EditorPermission::with('template')->where('editor_id',$auth_user_id)->get() as $editorpermission) {
            $template = $editorpermission->template;
			UCrypt::setKey($this->getSecret($editorpermission->dockey_enc, $auth_user_id));
			$data['templates'][] = [
			'id' => $template->id,
			'title'=> Ucrypt::decrypt($template->title),
			'editors' => $template->editor_count,
			'created_at' => $template->created_at];
		}
		//returns the fetched contracts index
		return view('templates.index', $data);
	}

	/**
	 * Show the form for creating a new contract.
	 *
	 * @return Response
	 */
	public function create()
	{
		//returns the TinyMCE Editor
		return view('templates.create');
	}

	/**
	 * Display the specified resource.
	 * GET /contracts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($contract_id)
	{
		//get contract data
        $contract_data = $this->getDocumentData($contract_id);
        //takes doc_id and appends to data array, then redirects to signature page

        $data = array(
        'contract_data'  => $contract_data,
        'subheading1'   => 'Documents',
        'subheading2' => 'Sign Document',
        'subheading3' => 'Sign'
        );

        //returns an signing page
        return view('contracts.show', $data);
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
		$contract = Auth::user()->contracts->find($id);
		if (is_null($contract)){
			abort(422);
		}
		Ucrypt::setKey(Cache::get($contract->creator_id));
		Ucrypt::setKey(Ucrypt::decrypt($contract->key_enc));
		$data = array('title' => Ucrypt::decrypt($contract->title), 'content' => Ucrypt::decrypt($contract->content));
		return view('contracts.create')->withData($data)->withPosturl('contracts/'.$id);
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
		$this->validate($request, [
			//if increasing the max size, also increase database
        'contract_title' => 'required|max:40',
        'contract_content' => 'required',
        'contract_type' => 'exists:contract_types,id',
    	]);

		// set creator id
 		$creator_id = Auth::user()->id;
        // generate this contract's key
        $contract_key = str_random(32);
        //encrypt contract key
        UCrypt::setKey(Cache::get($creator_id));
        $contractkey_enc = UCrypt::encrypt($contract_key);
        //encrypt contract title and content with contract key
        UCrypt::setKey($contract_key);
        $contract_title = UCrypt::encrypt($request->contract_title);
        $contract_content = UCrypt::encrypt($request->contract_content);
        // store in database
        $contract = Document::create([
        	'title' => $contract_title,
        	'content' => $contract_content
        	]);
        $contract->creator_id = $creator_id;
        $contract->contracttype_id = $request->contract_type;
        $contract->key_enc = $contractkey_enc;
        $contract->save();
 
        $response = array(
            'status' => 'success',
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
        'contract_title' => 'required|max:40',
        'contract_content' => 'required',
        'contract_type' => 'exists:contract_types,id',
    	]);

		// get input
 		$contract = Auth::user()->contracts->find($id);
        $contract_title = $request->contract_title;
        $contract_content = $request->contract_content;
        
        if (is_null($contract)) {
        	abort(422);
        }
        //save the encrypted stuff
        UCrypt::setKey(Cache::get($contract->creator_id));
        UCrypt::setKey(UCrypt::decrypt($contract->key_enc));
        if (UCrypt::decrypt($contract->title) != $contract_title || UCrypt::decrypt($contract->content) != $contract_content) {
        	$contract->title = UCrypt::encrypt($contract_title);
	        $contract->content = UCrypt::encrypt($contract_content);
	        $contract->hash = '';
	        $contract->save();
        }

        $response = array(
            'status' => 'success',
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
     * Fetch contract data from database.
     *
     * @return string $contract_data
     */
    protected function getDocumentData($contract_id)
    {
        $auth_user_id = Auth::user()->id;
        $contract = Document::with('signatures.details.address','filerecords', 'contracttype')->find($contract_id);
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
        $data['title'] = UCrypt::decrypt($contract->title);
        $data['body'] = UCrypt::decrypt($contract->content);
        $data['contracttype'] = $contract->contracttype->name;
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
        $doc->load(base_path('resources/xmltemplates/').$data['contracttype'].'.xml');
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

    protected function getSecret($enc_key, $auth_user_id){
        $pkeyname = Cache::get($auth_user_id.'priv').'.pem';
        openssl_private_decrypt(
            base64_decode($enc_key),
            $key,
            openssl_pkey_get_private(
                file_get_contents(storage_path('keys').'/'.$pkeyname),
                Cache::get($auth_user_id)
            )
        );
    }
}
