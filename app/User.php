<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Encryption;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['f_name', 'l_name', 'email', 'password'];

    /**
     * The attributes that are encrypted.
     *
     * @var array
     */
    protected $encrypted = ['key_enc', 'signkeyname_enc'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get all of the contracts created by the user.
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'creator_id');
    }

    /**
     * Get all of the signatures created by the user.
     */
    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    /**
     * Get the user's adress.
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
