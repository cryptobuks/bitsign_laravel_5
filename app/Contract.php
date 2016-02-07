<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    /**
	 * The parts of the users table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = ['title','content','contracttype_id'];

	/**
     * Get the user that created the contract.
     */

	public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the filerecords attached to this contract.
     */

    public function filerecords()
    {
        return $this->hasMany(FileRecord::class);
    }

    /**
     * Get all of the signatures attached to this contract.
     */

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    /**
     * Get this contract's type.
     */

    public function contracttype()
    {
        return $this->belongsTo(ContractType::class);
    }
}
