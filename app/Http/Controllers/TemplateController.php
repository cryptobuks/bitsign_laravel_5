<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use App\EditorPermission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
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
	 * Display a listing of the templates created by the current user
	 * GET /templates
	 *
	 * @return Response
	 */
	public function index()
	{
        $auth_user = JWTAuth::parseToken()->authenticate();
        $auth_user_id = $auth_user->id;
		$templates = array();
        $criteria = ['creator_id'=>$auth_user_id];
		foreach (Template::with('creator')->where($criteria)->get() as $key => $template) {
			$templates[] = [
			'id' => $template->id,
			'title'=> $template->title,
            'creator'=> $auth_user->f_name.' '.$auth_user->l_name,
            'collaborators'=>$template->editor_count,
			'created_at' => $template->created_at
			];
		}
        $editorpermissions = EditorPermission::with('template.creator')->where(['editor_id' => $auth_user_id, 'accepted' => true]);
        foreach ( $editorpermissions as $ep) {
            $template = $ep->template;
            $creator = $template->creator;
            $templates[] = [
            'id' => $template->id,
            'title'=> $template->title,
            'creator'=> $creator->f_name.' '.$creator->l_name,
            'collaborators'=>$template->editor_count,
            'created_at' => $template->created_at
            ]; 
        }
		//returns the fetched templates index
		return response()->json($templates);
	}

	/**
	 * Return the template data for displaying in client side.
	 * GET /templates/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//template data
		$templateraw = JWTAuth::parseToken()->authenticate()->templates->find($id);
		if (is_null($templateraw)){
			abort(422);
		}
		Ucrypt::setKey(Cache::get($templateraw->creator_id));
		Ucrypt::setKey(Ucrypt::decrypt($templateraw->key_enc));

		$template = [
        'id' => $templateraw->id,
        'title' => $templateraw->title,
        'clauses' => UCrypt::decrypt($templateraw->clauses),
        'terms' => UCrypt::decrypt($templateraw->terms),
        'parties' => UCrypt::decrypt($templateraw->parties),
        'attachments' => UCrypt::decrypt($templateraw->attachments),
        ];
        return response()->json($template);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /templates/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	
	public function store(Request $request)
	{
        // set creator id
        $creator_id = JWTAuth::parseToken()->authenticate()->id;

        //validate

        //if template exists
        if (!isset($request->id) || $request->id=='new') {
            // generate this template's key
            $template_key = str_random(32);
            //encrypt template key
            UCrypt::setKey(Cache::get($creator_id));
            $templatekey_enc = UCrypt::encrypt($template_key);
            //encrypt template title and content with template key
            UCrypt::setKey($template_key);
            $template = new Template;
            $template->key_enc = $templatekey_enc;
            $template->editor_count = 0;
        }

        else {
            $template = JWTAuth::parseToken()->authenticate()->templates->find($request->id);
            //save the encrypted stuff
            UCrypt::setKey(Cache::get($template->creator_id));
            UCrypt::setKey(UCrypt::decrypt($template->key_enc));
        }

        // store in database
        $template->title = $request->title;
        $template->clauses = UCrypt::encrypt($request->clauses);
        $template->terms = UCrypt::encrypt($request->terms);
        $template->parties = UCrypt::encrypt($request->parties);
        $template->attachments = UCrypt::encrypt($request->attachments);
        $template->creator_id = $creator_id;
        $template->save();
 
        $response = array(
            'success' => 'true',
            'template_id' => $template->id
        );
 
        return response()->json( $response );
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /templates/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
