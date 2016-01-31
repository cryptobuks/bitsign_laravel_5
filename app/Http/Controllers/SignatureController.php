<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contract;
use App\User;
use UCrypt;

class SignatureController extends Controller
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
    public function index($contract_id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contract_id)
    {
        //check if user has a key, else redirect
        if ($this->noKey(Auth::user()->id)) {
            return redirect()->action('KeyController@create', [$contract_id]);
        }
        //get contract data
        $contract_data = $this->getContractData($contract_id);
        //takes doc_id and appends to data array, then redirects to signature page

        $data = array(
        'contract_id'  => $contract_id,
        'subheading1'   => 'Contracts',
        'subheading2' => 'Sign Contract',
        'subheading3' => 'Sign'
        );

        //returns an signing page
        return view('signature.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user_id = Auth::user()->id;
        $signeevalidity = $this->isInContract($user_id, $request->contract_id);
        if ($this->noKey($user_id)) {
            return response()->json(['success' = 3]);
        }
        if ($signeevalidity=='complete') {
            return response()->json(['success' = 2]);
        }
        if ($signeevalidity) {
            $this->signIt($contract_id);
            return response()->json(['success' = 1]);
        }
        return response()->json(['success' = 0]);
        //set XMLDigitalSignature options
        XmlDSig::setCryptoAlgorithm(1);
        XmlDSig::setDigestMethod('sha512');
        XmlDSig::forceStandalone();
        //load the private key
        try
        {
            XmlDSig::loadPrivateKey(storage_path('keys/private.pem'), 'MrMarchello');
            XmlDSig::loadPublicKey(storage_path('keys/public.pem'));
            XmlDSig::loadPublicXmlKey(storage_path('keys/public.xml'));
        }
        catch (\UnexpectedValueException $e)
        {
            print_r($e);
            exit(1);
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
     * Sign the contract.
     *
     * @param  int  $contract_id
     * @return null
     */
    protected function signIt($contract_id)
    {
        //check key in cache
        //if none, login again
        //if key exists, decode the privatekey to memory
        //check document existence, if not, create
    }

    /**
     * Check if the user has a private keyfile
     *
     * @param  int user_id
     * @return boolean
     */
    protected function noKey($user_id)
    {
        return is_null(User::find($user_id)->signkeyname_enc);
    }

    /**
     * Check if this user is in this contract's signature records.
     *
     * @param  int  $user_id
     * @param  int  $contract_id
     * @return boolean or string 'complete'
     */
    protected function isInContract($user_id, $contract_id)
    {
        $signees = Contract::find($contract_id)->signatures;
        foreach ($signees as $signee) {
            if ($signee->id==$user_id) {
                if ($signee->status==0) {
                    return true;
                }
                return 'complete';
            }
        }
        else return false;
    }

    /**
     * Fetch from database or filesystem.
     *
     * @return string $contract_data
     */
    protected function getContractData($contract_id)
    {
        $auth_user_id = Auth::user()->id;
        $contract = Contract::find($contract_id);
        //set filepath
        $filepath = storage_path('contracts/').$contract_id.'.xml';
        //get the contract decryption key
        if ($contract->user_id != $auth_user_id) {
            $pkeyname = Cache::get($auth_user_id.'priv').'.xml';
            $pubenc_contractkey = $contract->signatures->where('user_id',$auth_user_id)->contractkey_enc;
            openssl_private_decrypt(
                $pubenc_contractkey,
                $dcrypted_contractkey,
                openssl_pkey_get_private(
                    file_get_contents(storage_path('keys').'/'.$pkeyname),
                    Cache::get($auth_user_id)
                )
            );
        }
        else {
            $contract->setSecret(Cache::get($auth_user_id));
            $dcrypted_contractkey = $contract->key;
        }
        //if document exists, confirm hash and return loaded string
        if (file_exists($filepath)) {
            //set key
            UCrypt::setKey($dcrypted_contractkey);
            //get encrypted data
            $encrypteddata = Storage::get($filepath);
            //decrypt
            $contract_data = UCrypt::decrypt($encrypteddata);
            //check hash and return
            if (base64_encode(hash($contract_data))==$contract->hash) {
                return $contract_data;
            }
        }
        //else if auth user is creator, assemble from database, write to file, return string 
        //Check whether this user has permission to edit this contract
        if ($contract->user_id != $auth_user_id){
            abort(422);
        }
        $contract->setSecret($dcrypted_contractkey);
        return $contract_data = $this->assembleDoc($contract, $filepath);
    }

    /**
     * Assemble the XML from everything.
     *
     * @return string $contract_data
     */
    protected function assembleDoc(Contract $contract, $filepath)
    {
        //the password should already be set, so just access
        $contract_title = $contract->title;
        $contract_body = $contract->content;
        $filerecords = $contract->filerecords;
        $signeerecords = $contract->signatures;
        //arrange the signing individuals into parties
        foreach ($signeerecords as $signeerecord) {
            $signee = User::find($signeerecord->user_id);
            $parties[$signeerecord->term][] = [$signee->f_name.' '.$signee->l_name, $signee->address];
        }
        //load xml from template
        $contracttype = $contract->contracttype;
        $doc = new \DOMDocument;
        $doc->load(storage_path('xmltemplates/legalxml/').$contracttype->name.'.xml');
        //set title
        $doc_title = $doc->getElementById('title');
        $doc_title->nodeValue = $contract_title;
        //set date
        $doc_date = $doc->getElementsByTagName('date')[0];
        $doc_date->nodeValue = date(DATE_RFC2822);
        //set parties
        $partiesnode = $doc->getElementsByTagName('parties')[0];
        foreach ($parties as $party => $personrecords) {
            $partynode = $partiesnode->appendChild($doc->createElement("party"));
            $firstpass = true;
            foreach ($personrecords as $personrecord) {
                if ($firstpass) {
                    $firstpass = false;
                }
                else{
                    $partynode->appendChild($partynode->createTextNode("and"));
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
        $newnode->appendXML(str_replace('&nbsp;', '&#xA0;', $contract_body));
        $doc->getElementById('contract-content')->appendChild($newnode);
        //write filerecords
        $attachmentsnode = $doc->getElementsByTagName('attachments')[0];
        foreach ($filerecords as $filerecord) {
            $attachmentnode = $attachmentsnode->appendChild($doc->createElement('attachment'));
            $objectnode = $attachmentnode->appendChild($doc->createElement('object'));
            $objectnode->setAttribute("type", $filerecord->type);
            $datanode = $objectnode->appendChild($doc->createElement('data'));
            $datanode->setAttribute("src", $filerecord->filename);
            $hashnode = $objectnode->appendChild($doc->createElement('hash', $filerecord->hash));
            $hashnode->setAttribute("algorithm", "sha384");
        }
        //save the file
        $doc->save($filepath);
        //save the hash of it
        $contract->hash = base64_encode(hash_file('sha384', $filepath, true));
        //encrypt the document
        $unencryptedfile = Storage::get($filepath);
        UCrypt::setKey($contract->key);
        Storage::put($filepath, UCrypt::encrypt($unencryptedfile));
        //return the contract data
        return $doc->saveXML();
    }
}
