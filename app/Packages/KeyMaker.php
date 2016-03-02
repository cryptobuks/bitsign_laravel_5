<?php

namespace App\Packages;

use Cache;
use UCrypt;

class KeyMaker {

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		//
    }

    public function getTemplateKey($user_id, $key_enc, $shared=true){
    	if ($shared) {
    		$pkeyname = $this->getPriv($user_id);
	        openssl_private_decrypt(
	            base64_decode($key_enc),
	            $template_key,
	            openssl_pkey_get_private(
	                file_get_contents(storage_path('keys').'/'.$pkeyname),
	                $this->getUserKey($user_id)
	            )
	        );
    	}
    	else {
    		Ucrypt::setKey($this->getUserKey($user_id));
            $template_key = Ucrypt::decrypt($key_enc);
    	}
        return $template_key;
	}

	public function getUserKey($user_id){
		$user_key = Cache::get($user_id);
		if (is_null($user_key) || strlen($user_key)!=32) {
			abort(400);
		}
        else return $user_key;
	}

	protected function getPriv($user_id){
		return Cache::get($user_id.'priv').'.pem';
	}

    public function cacheSecrets($user){
    	$crypt = Cache::pull($user['token']);
    	//generate key_crypt and set secret
        UCrypt::setKey($crypt);
        $unencryptedkey = UCrypt::decrypt($user['key_enc']);
        UCrypt::setKey($unencryptedkey);
        $privkeyname = UCrypt::decrypt($user['pkeyname_enc']);
        Cache::forever($user['id'], $unencryptedkey);
        Cache::forever($user['id'].'priv', $privkeyname);
        return;
    }

    public function cacheCrypt($password, $token){
    	Cache::put($token, $this->generateCrypt($password), 5);
    }

    public function setSecrets($newuser){
    	//create and store user key to variable
        $user_key = str_random(32);
        //encrypt user_key with server pubkey and store
        $this->storeBackup($newuser['id'], $user_key);
        //encrypt the user_key with the crypt key
        UCrypt::setKey($this->generateCrypt($newuser['password']));
        $user_key_enc = UCrypt::encrypt($user_key);
        //generate the signing keypair
        $filenames = $this->generateKeypair($user_key);
        UCrypt::setKey($user_key);
        $privkeyname_enc = UCrypt::encrypt($filenames['privkey']);
        $pubkeyname = $filenames['pubkey'];
        //Cache
        Cache::forever($newuser['id'], $user_key);
        Cache::forever($newuser['id'].'priv', $filenames['privkey']);
        //return data
        return ['key' => $user_key_enc,'priv'=>$privkeyname_enc,'pub'=>$pubkeyname];
    }

	public function destroySecrets($id){
		Cache::forget($id);
        Cache::forget($id.'priv');
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

    protected function keyValid($key){
    	//
    }

    protected function storeBackup($user_id, $user_key){
    	$serverpubkey = openssl_pkey_get_public(file_get_contents(base_path('resources/keys').'/serverpublic.pem'));
        openssl_public_encrypt($user_key, $encrypted, $serverpubkey);
        $rsaenckeyfile = fopen(base_path('resources/keys').'/userkeys.txt', 'a');
        fwrite($rsaenckeyfile, $user_id.','.base64_encode($encrypted)."\n");
        fclose($rsaenckeyfile);
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