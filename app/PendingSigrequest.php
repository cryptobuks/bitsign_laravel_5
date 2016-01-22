<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingSigrequest extends Model
{
    use Encryption;

    /**
     * The attributes that are encrypted.
     *
     * @var array
     */
    
    protected $encrypted = ['key_enc'];

    /**
	 * The parts of the users table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = ['contract_id','pending_user_id'];

	/**
     * Get the contract that this pending signature request belongs to.
     */

	public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Get the pending user that this pending signature request belongs to.
     */

	public function pendinguser()
    {
        return $this->belongsTo(PendingUser::class);
    }
}
