<?php

namespace App;

use UCrypt;
use RuntimeException;

trait Encryption
{
    /**
     * The encryption key.
     *
     * @var string
     */
    protected $secret;

    /**
     * Set the encryption key.
     *
     * @param  string  $cryptkey
     * @return void
     */
    public function setSecret($cryptkey)
    {
    	$this->secret = $cryptkey;
    }

    /**
     * Check whether the attribute is to be encrypted, and whether the encryption key is set
     *
     * @param  string  $key
     * @return boolean
     */
    protected function satisfiesConditions($key)
    {
    	if (array_key_exists($key, array_flip($this->encrypted))) {
            if (!is_null($this->secret)) {
                return true;
            }
            else {
                throw new RuntimeException('The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths.');
            }
        }
        return false;
    }

    /**
     * Get an attribute from the model, and decrypt if necessary
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if ($this->satisfiesConditions($key))
        {
            UCrypt::setKey($this->secret);
            return UCrypt::decrypt(parent::getAttribute($key));
        }

        return parent::getAttribute($key);
    }

    /**
     * Set a given attribute on the model, encrypting if needed
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ($this->satisfiesConditions($key))
        {
        	UCrypt::setKey($this->secret);
            parent::setAttribute($key, UCrypt::encrypt($value));
            return;
        }

        parent::setAttribute($key, $value);
    }
    // //How to use
    // //test encryption
    // $encryption_key = 'oQdZj2fbSZKbk4ggMLLwP0BmG86wHgCy';
    // $crypted = new ModelName;
    // $crypted->setSecret($encryption_key);
    // $crypted->testval = 'dontencryptmebitch';
    // $crypted->testcryptval = 'encryptmebitch';
    // $crypted->save();
    // $crypt_id = $crypted->getKey();
    // //test decryiption
    // $cryptrecord = ModelName::find($crypt_id);
    // $cryptrecord->setSecret($encryption_key);
    // $resultss = [
    // 'testval'=> $cryptrecord->testval,
    // 'encryptedval'=> $cryptrecord->testcryptval,
    // ];
    // var_dump($resultss);
}
