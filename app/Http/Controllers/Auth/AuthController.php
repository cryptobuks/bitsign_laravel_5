<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Socialite;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
            'agree' => 'accepted',
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
        $user->setSecret($this->generateCrypt($data['password']));
        $user->key_enc = Str::random(32);
        $user->save();
        return $user;
        //send a (encrypted with recovery server pubkey) packet containing user id and $key_crypt
        //openssl_public_encrypt($data, $encrypted, $pubKey);
        //guzzle client, send to remote server
    }

    /**
     * Generate the key_crypt.
     *
     * @param  string  $password
     * @return binary string
     */
    protected function generateCrypt($password)
    {
        return hash('sha256', $password.config('app.secret'), true);
    }

}
