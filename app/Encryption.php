<?php

namespace App;

use UCrypt;

trait Encryption
{
    /**
     * The attributes that should be encrypted.
     *
     * @var string
     */
    protected $encrypted[];

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
    	return array_key_exists($key, array_flip($this->encrypted)) && !is_null($this->secret);
    }

    /**
     * Get an attribute from the model, and decrypt if necessary
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (satisfiesConditions($key))
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
        if (satisfiesConditions($key))
        {
        	UCrypt::setKey($this->secret);
            parent::setAttribute($key, UCrypt::encrypt($value));
            return;
        }

        parent::setAttribute($key, $value);
    }
}
