<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditorPermission extends Model
{
    protected $fillable = [];

    /**
     * Get the document that this editing record belongs to.
     */

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

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

	public function details()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

}
