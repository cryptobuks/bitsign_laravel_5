<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Socialite;
use Auth;
use Cache;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = 'dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Override default method of AuthenticatesAndRegistersUsers Trait
     * redirect to login pages
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin($provider = null)
    {
        
        if (!is_null($provider)) {
            return Socialite::driver($provider)->redirect();
        }
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('auth.login');
    }

    /**
     * Obtain the user information from provider
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $validator = Validator::make(
                array('provider' => $provider),
                array('provider' => 'required|in:facebook,google,slack,github')
            );

        if ($validator->fails()) {
            abort(404, 'Unauthorized action.');
        }
        
        $user = Socialite::driver($provider)->user();
         
        // storing data to our use table and logging them in
        $names = explode(" ", $user->getName());
        $data = [
            'email' => $user->getEmail(),
            'f_name' => $names[0],
            'l_name' => $names[1] ?: ''
        ];

        $validator = Validator::make(
                $data, [
            'email' => 'required|email|max:255',
            'f_name' => 'required|alpha|max:50',
            'l_name' => 'required|alpha|max:50',
        ]);

        if ($validator->fails()) {
            abort(422, 'Invalid Email, or Empty Name');
        }
     
        Auth::login(User::firstOrCreate($data));

        //after login redirecting to home page
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Cache::forget(Auth::user()->id);
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //create the new user
        $user = User::create([
            'f_name' => $data['f_name'],
            'l_name' => $data['l_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        //create and store user key (auto encrypted)
        $user_key = str_random(32);
        $user->setSecret($this->generateCrypt($data['password']));
        $user->key_enc = $user_key;
        $user->save();
        //encrypt user_key with servel pubkey and store
        $serverpubkey = openssl_pkey_get_public(file_get_contents(storage_path('keys').'/serverpublic.pem'));
        openssl_public_encrypt($user_key, $encrypted, $serverpubkey);
        $rsaenckeyfile = fopen(storage_path('keys').'/userkeys.txt', 'a');
        fwrite($rsaenckeyfile, $user->id.','.base64_encode($encrypted)."\n");
        fclose($rsaenckeyfile);
        //generate the signing keypair
        $filenames = $this->generateKeypair($user_key);
        $user->setSecret($user_key);
        $user->signkeyname_enc = $filenames['privkey'];
        $user->pubkey = $filenames['pubkey'];
        $user->save();
        return $user;
    }

    /**
     * Decrypt and cache the user's encryption key.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, User $user)
    {
        //generate key_crypt and set secret
        $user->setSecret($this->generateCrypt($request->password));
        $unencryptedkey = $user->key_enc;
        Cache::forever($user->id, $unencryptedkey);
        return redirect()->intended($this->redirectPath());
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
        return ['privkey'=>$privfilename, 'pubkey' => $pubfilename];
    }

}
