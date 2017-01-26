<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postcodes extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'postcodes';

	public function busstops() {

		return $this->hasMany('App\Models\Busstops', 'postcode_id', 'id');
	}
	public function schools() {

		return $this->hasMany('App\Models\Schools', 'postcode_id', 'id');
	}
	public function addresses() {

		return $this->hasMany('App\Models\Addresses', 'postcode_id', 'id');
	}
}
