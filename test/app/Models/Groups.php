<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';
	/*
		*Let the mysql do some work for as substring and orderby
		* short version of postcode substring SE12
	*/
	public function childrens() {
		return $this->hasMany('App\Models\Postcodes')
			->selectRaw(' *, SUBSTRING( postcode, 1 , 4) as aggregate')
			->orderByRaw('postcode');
	}
}
