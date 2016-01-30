<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Cache;

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
		//returns the fetched contracts index
		return view('contracts.index');
	}

	/**
	 * Show the form for creating a new contract.
	 *
	 * @return Response
	 */
	public function create()
	{
		//returns the TinyMCE Editor
		return view('contracts.create');
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
 		$name = $request->name;
        $contract_title = $request->contract_title;
        $contract_content = $request->contract_content;

        // store in database
        $contract = new Contract;
        $contract->setSecret(Cache::get(Auth::user()->id));
        $contract->title = $contract_title;
        $contract->content = $contract_content;
        $contract->user_id = $creator_id;
        $contract->contracttype_id = $request->contract_type;
        $contract->key = str_random(32);
        $contract->save();
        $contract_id = $contract->getKey();
 
        $response = array(
            'status' => 'success',
            'contract_id' => $contract_id
        );
 
        return response()->json( $response );
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
