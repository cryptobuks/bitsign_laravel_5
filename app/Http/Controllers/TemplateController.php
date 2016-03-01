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
		$templateraw = $auth_user->templates->find($id);
		if (is_null($templateraw)){
            $permission = EditorPermission::with('template')->where(['editor_id' => $auth_user->id, 'template_id'=>$id])->first();
            if (is_null($permission)) {
                abort(422);
            }
            $templateraw = $permission->template;
            $pkeyname = Cache::get($auth_user_id.'priv').'.pem';
            $pubenc_contractkey = $permission->key_enc;
            openssl_private_decrypt(
                base64_decode($pubenc_contractkey),
                $dcrypted_contractkey,
                openssl_pkey_get_private(
                    file_get_contents(storage_path('keys').'/'.$pkeyname),
                    Cache::get($auth_user_id)
                )
            );
            UCrypt::setKey($dcrypted_contractkey);
		}
        else{
            Ucrypt::setKey(Cache::get($templateraw->creator_id));
            Ucrypt::setKey(Ucrypt::decrypt($templateraw->key_enc));
        }

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
        if (!isset($template_id) || $template_id=='new') {
            // generate this template's key
            $template_key = str_random(32);
            //encrypt template key
            UCrypt::setKey(Cache::get($auth_user_id));
            $templatekey_enc = UCrypt::encrypt($template_key);
            //encrypt template title and content with template key
            UCrypt::setKey($template_key);
            $template = new Template;
            $template->key_enc = $templatekey_enc;
            $template->editor_count = 0;
        }

        else {
            if (is_null($template = $auth_user->templates->find($template_id))){
                $permission = EditorPermission::with('template')->where(['editor_id' => $auth_user->id, 'template_id'=>$template_id])->first();
                if (is_null($permission)) {
                    abort(422);
                }
                $editing = true;
                $template = $permission->template;
                $pkeyname = Cache::get($auth_user_id.'priv').'.pem';
                $pubenc_contractkey = $permission->key_enc;
                openssl_private_decrypt(
                    base64_decode($pubenc_contractkey),
                    $dcrypted_contractkey,
                    openssl_pkey_get_private(
                        file_get_contents(storage_path('keys').'/'.$pkeyname),
                        Cache::get($auth_user_id)
                    )
                );
                UCrypt::setKey($dcrypted_contractkey);
            }
            else{
                Ucrypt::setKey(Cache::get($template->creator_id));
                Ucrypt::setKey(Ucrypt::decrypt($template->key_enc));
            }
        }

        // store in database
        $template->title = $request->title;
        $template->clauses = UCrypt::encrypt($request->clauses);
        $template->terms = UCrypt::encrypt($request->terms);
        $template->parties = UCrypt::encrypt($request->parties);
        $template->attachments = UCrypt::encrypt($request->attachments);
        if (!isset($editing)) {
            $template->creator_id = $auth_user_id;
        }
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
