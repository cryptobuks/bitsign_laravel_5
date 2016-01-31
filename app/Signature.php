<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = [];

    /**
     * Get the contract that this signature belongs to.
     */

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Get the user that created this signature.
     */

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
