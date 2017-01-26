<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class TravelController extends Controller {
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getInfo() {

		$parents = \App\Models\Groups::with('childrens')->get();
		foreach ($parents as $parent) {
			$group[$parent->name] = $parent->childrens->groupBy('aggregate');
		}

		return view('home')->with(compact('group'));
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function infoData(Request $request) {

		//	\DB::enableQueryLog();

		//	$postcodes = \App\Models\Postcodes::find($request->data);
		/**
		 * The referen.. as  starting point.
		 * #$ref = array(49.648881, -103.575312);
		 * @var array
		 */
		//	$ref = array($postcodes->latitude, $postcodes->longitude);
		/**
		 * Get the colection of schools
		 *
		 * @return Schools
		 */
		//	$schools = \App\Models\Schools::whereNotNull('latitude')->get();

		#trying to force mysql do the mat. :(

		//->selectRaw(" latitude, longitude ,(((ACOS(SIN(RADIANS('latitude')) * SIN(RADIANS({$postcodes->latitude})) + COS(RADIANS('latitude')) * COS(RADIANS({$postcodes->latitude})) * COS(RADIANS('longitude' - {$postcodes->longitude}))))*180/PI()) * 60 * 1.1515) AS distance")->get();

		//dd(\DB::getQueryLog(), $ref, $schools->toArray());
		/**
		 * Get the colection of schools
		 *
		 * @return distances
		 */
		//	$distances = $schools->map(function ($item, $key) use ($ref) {
		//		$a = array_flatten(array_slice($item->toArray(), -2)); #if are latitude and longitude last two in the array return them
		//		return $this->distance($a, $ref); # calculate distance
		//	});

		//	$distances->all();

		//	dd($ref, $distances, $schools->toArray());
		$postcode = \App\Models\Postcodes::with('addresses', 'schools', 'busstops')->find($request->data);
		$schools = $postcode->schools;
		$addresses = $postcode->addresses;
		$busstops = $postcode->busstops;
		//	dd(DB::getQueryLog(), $schools->toArray(), $addresses->toArray(), $busstops->toArray());

		return response()->json(compact('schools', 'addresses', 'busstops'));

	}
	public function distance($a, $b) {

		list($lat1, $lon1) = $a;
		list($lat2, $lon2) = $b;

		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist); // $dist*180/pi()
		$miles = round($dist * 60 * 1.1515 * 1.609344, 2); ///1.609344 km
		return $miles;
	}
}