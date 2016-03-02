<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use App\EditorPermission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use UCrypt;
use App\Packages\KeyMaker;

class TemplateController extends Controller
{	
    protected $keymaker;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('jwt.auth');
        $this->keymaker = new KeyMaker;
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
        $editorpermissions = EditorPermission::with('template.creator')->where(['editor_id' => $auth_user_id, 'accepted' => true])->get();
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
        $auth_user = JWTAuth::parseToken()->authenticate();
        $auth_user_id = $auth_user->id;
		if (is_null($templateraw = $auth_user->templates->find($id))){
            $permission = EditorPermission::with('template')->where(['editor_id' => $auth_user->id, 'template_id'=>$id])->first();
            if (is_null($permission)) {
                abort(422);
            }
            $templateraw = $permission->template;
            $shared = true;
            $key_enc = $permission->key_enc;
		}
        else{
            $shared = false;
            $key_enc = $templateraw->key_enc;
        }
        $template_key = $this->keymaker->getTemplateKey($auth_user_id, $key_enc, $shared);
        UCrypt::setKey($template_key);
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
        $auth_user = JWTAuth::parseToken()->authenticate();
        $auth_user_id = $auth_user->id;
        $template_id = $request->id;

        //validate

        //if template is new
        if ($template_id=='new') {
            // generate this template's key
            $template_key = str_random(32);
            //set creator key
            $creator_key = $this->keymaker->getUserKey($auth_user_id);
            //encrypt template key
            UCrypt::setKey($creator_key);
            $templatekey_enc = UCrypt::encrypt($template_key);
            //encrypt template title and content with template key
            $template = new Template;
            $template->key_enc = $templatekey_enc;
            $template->editor_count = 0;
            $template->creator_id = $auth_user_id;
        }

        else {
            if (is_null($template = $auth_user->templates->find($template_id))){
                $permission = EditorPermission::with('template')->where(['editor_id' => $auth_user->id, 'template_id'=>$template_id])->first();
                if (is_null($permission)) {
                    abort(422);
                }
                $template = $permission->template;
                $key_enc = $permission->key_enc;
                $shared = true;
            }
            else{
                $key_enc = $template->key_enc;
                $shared = false;
            }
            $template_key = $this->keymaker->getTemplateKey($auth_user_id, $key_enc, $shared);
        }
        UCrypt::setKey($template_key);
        // store in database
        $template->title = $request->title;
        $template->clauses = UCrypt::encrypt($request->clauses);
        $template->terms = UCrypt::encrypt($request->terms);
        $template->parties = UCrypt::encrypt($request->parties);
        $template->attachments = UCrypt::encrypt($request->attachments);
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
