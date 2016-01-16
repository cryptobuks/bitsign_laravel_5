<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    /**
	 * The parts of the users table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = ['f_name', 'l_name', 'email', 'token'];

	/**
     * Get all of the signatures attached to this contract.
     */

    public function pendingsigrequests()
    {
        return $this->hasMany(PendingSigrequest::class);
    }
}
