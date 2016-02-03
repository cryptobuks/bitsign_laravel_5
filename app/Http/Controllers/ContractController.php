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
		$user = Auth::user();
		$secret = Cache::get($user->id);
		$contracts_raw = $user->contracts;
		foreach ($contracts_raw as $key => $contract) {
			UCrypt::setKey($secret);
			$contract_key = Ucrypt::decrypt($contract->key);
			UCrypt::setKey($contract_key);
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
		$contract = Contract::find($id);
		$auth_user_id = Auth::user()->id;
		if ($contract->user_id!=$auth_user_id){
			abort(422);
		}
		Ucrypt::setKey(Cache::get($auth_user_id));
		Ucrypt::setKey(Ucrypt::decrypt($contract->key));
		$data = array('title' => Ucrypt::decrypt($contract->title), 'content' => Ucrypt::decrypt($contract->content));
		return view('contracts.create')->withData($data)->withPosturl('contracts/'.$contract->id);
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
        'contract_title' => 'required|unique:contracts,title|max:40',
        'contract_content' => 'required',
        'contract_type' => 'exists:contract_types,id',
    	]);

		// get input
 		$creator_id = Auth::user()->id;
        $contract_title = $request->contract_title;
        $contract_content = $request->contract_content;

        $contract_key = str_random(32);
        // store in database
        $contract = new Contract;
        $contract->setSecret(Cache::get($creator_id));
        $contract->user_id = $creator_id;
        $contract->contracttype_id = $request->contract_type;
        $contract->key = $contract_key;
        $contract->save();
        $contract_id = $contract->getKey();
        //save the encrypted stuff
        //new object
        $contract = Contract::find($contract_id);
        $contract->setSecret($contract_key);
        $contract->title = $contract_title;
        $contract->content = $contract_content;
        $contract->save();
 
        $response = array(
            'status' => 'success',
            'contract_id' => $contract_id
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
        'contract_title' => 'required|unique:contracts,title|max:40',
        'contract_content' => 'required',
        'contract_type' => 'exists:contract_types,id',
    	]);

		// get input
 		$creator_id = Auth::user()->id;
        $contract_title = $request->contract_title;
        $contract_content = $request->contract_content;
        
        //save the encrypted stuff
        //new object
        $contract = Contract::find($id);
        UCrypt::setKey(Cache::get($creator_id));
        $contract->setSecret(UCrypt::decrypt($contract->key));
        $contract->title = $request->contract_title;
        $contract->content = $request->contract_content;
        $contract->save();
 
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
