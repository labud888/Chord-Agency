<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schools extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'schools';

	public function parent() {
		return $this->belongsTo('App\Models\Postcodes');
	}
}
