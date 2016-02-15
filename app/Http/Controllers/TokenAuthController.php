<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use UCrypt;
use Cache;
use Validator;
 
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
        Cache::forever($token, $this->generateCrypt($request->password));
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
        //set the user gey in cache
        $crypt = Cache::get(JWTAuth::getToken());
        Cache::forget(JWTAuth::getToken());
        $this->cacheKey($crypt, $user);
 
        return response()->json(compact('user'));
    }
 
    public function register(Request $request){
 
        $newuser= $request->all();
        $password=bcrypt($request->input('password'));
 
        $newuser['password'] = $password;
 
        return User::create($newuser);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'f_name' => 'required|alpha|max:50',
            'l_name' => 'required|alpha|max:50',
            'password' => 'required|confirmed|min:6',
            'terms' => 'accepted',
        ]);
    }

    /**
     * Decrypt and cache the user's encryption key.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    protected function cacheKey($crypt, User $user)
    {
        //generate key_crypt and set secret
        UCrypt::setKey($crypt);
        $unencryptedkey = UCrypt::decrypt($user->key_enc);
        UCrypt::setKey($unencryptedkey);
        $privkeyname = UCrypt::decrypt($user->signkeyname_enc);
        Cache::forever($user->id, $unencryptedkey);
        Cache::forever($user->id.'priv', $privkeyname);
        return;
    }

    /**
     * Generate the key_crypt.
     *
     * @param  string  $password
     * @return binary string
     */
    protected function generateCrypt($password)
    {
        return hash('sha256', $password.config('app.key'), true);
    }

    /**
     * Generate and store an ECDSA keypair.
     *
     * @return string $filename
     */
    protected function generateKeypair($passphrase)
    {
        $config = array(
        "private_key_bits" => 4096,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
        $privatekey = openssl_pkey_new($config);
        $details = openssl_pkey_get_details($privatekey);
        $publickey = $details['key'];
        $privfilename = str_random(32);
        $pubfilename = str_random(32);
        openssl_pkey_export_to_file($privatekey, storage_path('keys').'/'.$privfilename.'.pem', $passphrase);
        file_put_contents(storage_path('keys').'/'.$pubfilename.'.pem', $publickey);
        $this->generatePublicXML($details['rsa'], $pubfilename);
        return ['privkey'=>$privfilename, 'pubkey' => $pubfilename];
    }

    protected function generatePublicXML($rsa, $filename)
    {
        $xml = new \SimpleXMLElement("<RSAKeyValue/>"); // Use <RSAKeyPair/> for XKMS 2.0

        // .Net / XKMS openssl RSA indecies to XML element names mappings
        $map = ["n"    => "Modulus", "e"    => "Exponent"];

        foreach ($map as $key => $element) {
            $xml->addChild($element, base64_encode($rsa[$key]));
        }
        //export to file
        $xmlString = $xml->asXML();
        $xmlString = str_replace("<?xml version=\"1.0\"?>\n", '', $xmlString);
        file_put_contents(storage_path('keys/').$filename.'.xml', $xmlString);
    }
}