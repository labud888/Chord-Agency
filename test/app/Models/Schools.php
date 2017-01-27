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
	public function parent_all() {
		return $this->hasMany('App\Models\Postcodes', 'id', 'postcode_id')
			->selectRaw(' id,latitude,longitude')
			->orderByRaw('id');
	}
}
