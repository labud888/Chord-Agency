<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Busstops extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'busstops';

	public function parent() {
		return $this->belongsTo('App\Models\Postcodes');
	}
}
