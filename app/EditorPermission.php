<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditorPermission extends Model
{
    protected $fillable = [];

    /**
     * Get the document that this editing record belongs to.
     */

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Get the user that created this signature.
     */

	public function editor()
    {
        return $this->belongsTo(User::class);
    }

}
