<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingSignee extends Model
{
    /**
	 * The parts of the users table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = ['contract_id','email','token'];

	/**
     * Get the contract that this filerecord belongs to.
     */

	public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
