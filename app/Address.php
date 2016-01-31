<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
	 * The parts of the users table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = [];

	/**
     * Get the user whose addres this is.
     */

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
