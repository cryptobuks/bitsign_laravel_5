<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    /**
	 * The parts of the documents table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = ['title'];

	/**
     * Get this document's editors
     */

    public function editors()
    {
        return $this->hasMany(EditorPermission::class);
    }

    /**
     * Get this document's terms
     */

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    /**
     * Get this document's terms
     */
    public function clauses()
    {
        return $this->hasMany(Clause::class);
    }
}
