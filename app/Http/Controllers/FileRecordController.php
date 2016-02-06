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

		if ($frecords_raw = Contract::find($id)->filerecords) {
			foreach ($frecords_raw as $filerecord) {
				$data['filerecords'][] = ['filename'=>$filerecord->filename, 'hash'=>$filerecord->hash, 'id'=>$filerecord->id];
			}
		}
		
		//returns an uploader page
		return view('file.create', $data);
	}


	public function store(Request $request)
	{
		
		$contract_id = $request->contract_id;
		$auth_user = Auth::user();

		//instantiate arrays
		$errors = array();
	    $files = array();
	    //get the current contact
	    $contract = Contract::with('filerecords')->find($contract_id);
	    $contract->hash = '';
	    $contract->save();

		//Check whether this contract belongs to this user

		if ($contract->creator_id != $auth_user->id){
			$errors[] = 'You are not the creator. Get out now to avoid a lawsuit';
			return array(
				'files' => $files,
	        	'errors' => $errors
	    	);
		}

		//get the contract key
		$contract->setSecret(Cache::get($auth_user->id));
		$contract_key = $contract->key;

		//Set the upload parameters
		$assetPath = 'contracts/'.$contract_id.'/files';
		$uploadPath = storage_path($assetPath);
		$finfo = finfo_open(FILEINFO_MIME_TYPE);

		//Get files from POST Input
		$all_uploads = $request->file('files'); // your file upload input field in the form should be named 'files' or 'files[]'

		// Make sure it really is an array
	    if (!is_array($all_uploads)) {
	        $all_uploads = array($all_uploads);
	    }
	    //get current filerecords' hashes into array
	    $currentfilehashes = array();

	    foreach ($contract->filerecords as $key => $curfile) {
	    	$currentfilehashes[$key] = $curfile->hash;
	    }

	    $currentfilecount = count($currentfilehashes);

	    // Loop through all uploaded files
	    foreach ($all_uploads as $upload) {
		 	if ($currentfilecount >= 10) {
		 		$errors[] = 'File limit exceeded for this contract (Maximum 10 allowed tits!)';
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
					//hash
				 	$shafile = base64_encode(hash_file('sha384', $uploadPath.'/'.$filename, true));
				 	//get mimetype
				 	$mimetype = finfo_file($finfo, $uploadPath.'/'.$filename);
				 	//check whether file already exists for this contract
				 	if (array_search($shafile, $currentfilehashes) !== false) {
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
				        $filerecord->type = $mimetype;
				        $filerecord->encrypted = true;
				        $filerecord->save();
				        $currentfilecount++;
				        $files[] = array(
				        	'filename' => $upload->getClientOriginalName(),
				        	'hash' => $shafile,
				        	'id' => $filerecord->getKey()
				        	);
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
	 * POST /contracts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//Check whether this contract belongs to this user
		$filerecord = FileRecord::with('contract')->find($id);

		if ($filerecord->contract->creator_id != Auth::user()->id){
			$errors[] = 'You are not the creator. Get out now to avoid a lawsuit';
			return array(
				'files' => $files,
	        	'errors' => $errors
	    	);
		}

		$filerecord->delete();
		return response()->json(array('deleted' => $id));
	}
}
