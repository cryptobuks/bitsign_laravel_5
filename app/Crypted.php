<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crypted extends Model
{
    use Encryption;

    protected $fillable = ['testval'];
    protected $encrypted = ['testcryptval'];
}
