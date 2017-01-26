<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'addresses';

	public function postcodes() {
		return $this->belongsTo('App\Models\Postcodes', 'id');
	}
}
