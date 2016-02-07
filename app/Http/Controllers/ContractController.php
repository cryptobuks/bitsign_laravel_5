<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
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
        $this->middleware('auth');
    }

    /**
	 * Display a listing of the contracts created by the current user
	 * GET /contracts
	 *
	 * @return Response
	 */
	public function index()
	{
		$contracts = array();
		$auth_user_id = Auth::user()->id;
		$secret = Cache::get($auth_user_id);
		foreach (Contract::with('contracttype')->where('creator_id',$auth_user_id)->get() as $key => $contract) {
			UCrypt::setKey($secret);
			UCrypt::setKey(Ucrypt::decrypt($contract->key_enc));
			$contracts[$key] = [
			'id' => $contract->id,
			'title'=> Ucrypt::decrypt($contract->title),
			'type' => $contract->contracttype->name,
			'created_at' => $contract->created_at
			];
		}
		//returns the fetched contracts index
		return view('contracts.index')->withContracts($contracts);
	}

	/**
	 * Show the form for creating a new contract.
	 *
	 * @return Response
	 */
	public function create()
	{
		//returns the TinyMCE Editor
		return view('contracts.create')->withPosturl('contracts');
	}

	/**
	 * Display the specified resource.
	 * GET /contracts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
        $contract = Contract::create([
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
}
