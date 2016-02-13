<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clause extends Model
{
    /**
	 * The parts of the users table that are fillable.
	 *
	 * @var array
	 */

	protected $fillable = ['document_id', 'content_editing','content_approved'];
}
