<?php

namespace App\Packages;

use Illuminate\Encryption\Encrypter;

// app/extensions/UserEncrypter.php
class UserEncrypter extends Encrypter {

    public function setKey( $key ) {
        $this->key = (string) $key;
    }

}