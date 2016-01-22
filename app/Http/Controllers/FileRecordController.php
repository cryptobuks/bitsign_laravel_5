<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileRecord;
use App\Contract;
use Validator;
use Auth;
use Storage;
use Cache;
use UCrypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileRecordController extends Controller
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		//takes doc_id and appends to data array, then redirects to file import page

		$data = array(
    	'contract_id'  => $id,
    	'subheading1'   => 'Contracts',
    	'subheading2' => 'Create Contract',
    	'subheading3' => 'Attach Files'
		);

		//returns an uploader page
		return view('file.create', $data);
	}


	public function store(Request $request)
	{
		
		$contract_id = $request->contract_id;

		//instantiate arrays
		$errors = array();
	    $files = array();
	    //get the current contact
	    $contract = Contract::find($contract_id);

		//Check whether this contract belongs to this user

		if ($contract->user_id != Auth::user()->id){
			$errors[] = 'You are not the creator. Get out now to avoid a lawsuit';
			return array(
				'files' => $files,
	        	'errors' => $errors
	    	);
		}

		//get the contract key
		$contract->setSecret(Cache::get(Auth::user()->id));
		$contract_key = $contract->key;

		//Set the upload parameters
		$assetPath = 'uploads';
		$uploadPath = storage_path($assetPath);

		//Get files from POST Input
		$all_uploads = $request->file('files'); // your file upload input field in the form should be named 'files' or 'files[]'

		// Make sure it really is an array
	    if (!is_array($all_uploads)) {
	        $all_uploads = array($all_uploads);
	    }

	    // Loop through all uploaded files
	    foreach ($all_uploads as $upload) {

	    	$currentfiles = Contract::find($contract_id)->filerecords();
		 	if ($currentfiles->count() >= 10) {
		 		$errors[] = 'File limit exceeded for this contract (Maximum 10 allowed)';
		 		break;
		 	}
	        $validator = Validator::make(
	            array('file' => $upload),
	            array('file' => 'required|mimes:jpeg,png|image|max:1000')
	        );

	        if ($validator->passes()) {
	        	$original_name = $upload->getClientOriginalName();
	        	$salt = str_random(10);
	            $filename        = $salt.'_'.$original_name;
	        	$uploadSuccess   = $upload->move($uploadPath, $filename);
				if($uploadSuccess){
				 	$shafile = base64_encode(hash_file('sha384', $uploadPath.'/'.$filename, true));
				 	//check whether file already exists for this contract
				 	if ($currentfiles->where('hash', $shafile)->first()) {
				 		$errors[] = 'File ' . $upload->getClientOriginalName() . ' has already been added to this contract';
				 	}
				 	else{
				 		//encrypt
				 		$unencryptedfile = Storage::get($assetPath.'/'.$filename);
				 		UCrypt::setKey($contract_key);
				 		Storage::put($assetPath.'/'.$filename, UCrypt::encrypt($unencryptedfile));
				 		// store in database
				        $filerecord = new FileRecord;
				        $filerecord->hash = $shafile;
				        $filerecord->filename = $original_name;
				        $filerecord->salt = $salt;
				        $filerecord->contract_id = $contract_id;
				        $filerecord->encrypted = true;
				        $filerecord->save();
						$files[] = 'File ' . $upload->getClientOriginalName() . ' successfully added as hash value: ' . $shafile ;
				 	}
				} 
	        } 
	        else {
	            // Collect error messages
	            $errors[] = 'File ' . $upload->getClientOriginalName() . ':' . $validator->messages()->first('file');
	        }

	    }

	    // return our results in a files object
	    return array(
	        'files' => $files,
	        'errors' => $errors
	    );
	
	}
	
	/**
	 * Update the specified resource in storage.
	 * PUT /contracts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
}
