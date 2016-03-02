<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
use App\Http\Requests;
use App\Packages\KeyMaker;
use Illuminate\Http\Request;
use App\User;
 
class TokenAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
 
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        //generate and temporarily store crypt
        $keymaker = new KeyMaker;
        $keymaker->cacheCrypt($request->password, $token);
        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }
 
    public function getAuthenticatedUser()
    {
        try {
 
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
 
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
 
            return response()->json(['token_expired'], $e->getStatusCode());
 
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
 
            return response()->json(['token_invalid'], $e->getStatusCode());
 
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
 
            return response()->json(['token_absent'], $e->getStatusCode());
 
        }
        //set the user key in cache
        $keymaker = new KeyMaker;
        $keymaker->cacheSecrets([
            'id'=>$user->id,
            'token'=>JWTAuth::getToken(),
            'key_enc' => $user->key_enc,
            'pkeyname_enc' =>$user->signkeyname_enc
        ]);
 
        return response()->json(compact('user'));
    }
 
    public function register(Request $request){
 
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'f_name' => 'required|alpha|max:50',
            'l_name' => 'required|alpha|max:50',
            'password' => 'required|confirmed|min:6',
            'terms' => 'accepted',
        ]);

        $newuser = $request->only('email', 'f_name', 'l_name', 'password');
 
        return response()->json(compact($this->create($newuser)));
    }

    protected function create(array $newuser)
    {
        //Create the User
        $user = User::create([
            'f_name' => $newuser['f_name'],
            'l_name' => $newuser['l_name'],
            'email' => $newuser['email'],
            'password' => bcrypt($newuser['password'])
            ]);
        $newuser['id'] = $user->id;

        $keymaker = new KeyMaker;
        $secrets = $keymaker->setSecrets($newuser);
        //save rest of data to table
        $user->registered = true;
        $user->key_enc = $secrets['key'];
        $user->signkeyname_enc = $secrets['priv'];
        $user->pubkey = $secrets['pub'];
        $user->save();
        
        return $user;
    }

    public function unlink(){

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
 
        $keymaker = new KeyMaker;
        $keymaker->destroySecrets($user->id);
 
        return response()->json(['success' => true]);
    }
}