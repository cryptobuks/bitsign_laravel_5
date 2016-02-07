<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileRecord;
use App\Contract;
use Validator;
use Auth;
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
	public function create($contract_id)
	{
		$filerecords = Auth::user()->contracts->find($contract_id)->filerecords;
		//takes doc_id and appends to data array, then redirects to file import page
		$data = array(
    	'contract_id'  => $contract_id,
    	'subheading1'   => 'Contracts',
    	'subheading2' => 'Create Contract',
    	'subheading3' => 'Attach Files'
		);

		if (!is_null($filerecords)) {
			foreach ($filerecords as $filerecord) {
				$data['filerecords'][] = ['filename'=>$filerecord->filename, 'hash'=>$filerecord->hash, 'id'=>$filerecord->id];
			}
		}
		
		//returns an uploader page
		return view('file.create', $data);
	}


	public function store(Request $request)
	{
		$auth_user_id = Auth::user()->id;
		$contract = Contract::with('filerecords')->find($request->contract_id);

		//abort if not owner
		if ($contract->creator_id != $auth_user_id) {
			abort(422);
		}

		//get the contract key
		UCrypt::setKey(Cache::get($auth_user_id));
		$contract_key = UCrypt::decrypt($contract->key_enc);

		//get current filerecords' hashes into array
	    $currentfilehashes = array();
	    foreach ($contract->filerecords as $key => $curfile) {
	    	$currentfilehashes[$key] = $curfile->hash;
	    }
	    $currentfilecount = count($currentfilehashes);

		//Set the upload parameters
		$assetPath = storage_path('contracts/'.$contract->id.'/files');

		//Get files from POST Input, and cast single file to array
		$all_uploads = $request->file('files'); // your file upload input field in the form should be named 'files' or 'files[]'
	    if (!is_array($all_uploads)) {
	        $all_uploads = array($all_uploads);
	    }

	    //instantiate empty response arrays
		$errors = array();
	    $files = array();

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
	        	$filename = $upload->getClientOriginalName();
	        	$uploadSuccess   = $upload->move($assetPath, $filename);
				if($uploadSuccess){
					//hash
				 	$shafile = base64_encode(hash_file('sha384', $assetPath.'/'.$filename, true));
				 	//get mimetype
				 	$mimetype = mime_content_type($assetPath.'/'.$filename);
				 	//check whether file already exists for this contract
				 	if (array_search($shafile, $currentfilehashes) !== false) {
				 		$errors[] = 'File ' . $upload->getClientOriginalName() . ' has already been added to this contract';
				 	}
				 	else{
				 		//encrypt
				 		$unencryptedfile = file_get_contents($assetPath.'/'.$filename);
				 		UCrypt::setKey($contract_key);
				 		file_put_contents($assetPath.'/'.$filename, UCrypt::encrypt($unencryptedfile));
				 		// store in database
				        $filerecord = FileRecord::create([
				            'hash' => $shafile,
				            'filename' => $filename,
				            'contract_id' => $contract->id,
				            'type' => $mimetype,
				            'encrypted' => true
				        ]);
				        //increment counter
				        $currentfilecount++;
				        //reset contract
					    $contract->hash = '';
					    $contract->save();
					    //add to response
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
	            $errors[] = 'File ' . $filename . ':' . $validator->messages()->first('file');
	        }

	    }

	    // return our results in a files object
	    return array(
	        'files' => $files,
	        'errors' => $errors
	    );
	
	}

	/**
	 * Remove the specified resource from storage.
	 * GET /contracts/{id}
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
		//delete from filesystem
		$filepath = storage_path('contracts/'.$filerecord->contract->id.'/files/').$filerecord->filename;
		unlink($filepath);

		$filerecord->delete();
		return response()->json(array('deleted' => $id));
	}
}
