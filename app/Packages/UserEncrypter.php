<?php

namespace App\Packages;

use Illuminate\Encryption\Encrypter;

class UserEncrypter extends Encrypter {

	/**
     * Set the encryption key.
     *
     * @param  string  $key
     * @return void
     */
    public function setKey( $key ) {
        $this->key = (string) $key;
    }

}