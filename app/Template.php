<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    /**
	 * The parts of the users table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = [];

	/**
     * Get the user that created the contract.
     */

	public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get this document's editors
     */

    public function editors()
    {
        return $this->hasMany(EditorPermission::class);
    }
}
