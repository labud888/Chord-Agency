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

<<<<<<< HEAD
		$data = json_decode($request->postcode);

		$longitude = (float) $data->longitude;
		$latitude = (float) $data->latitude;
		$radius = 20;
		$lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
		$lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
		$lat_min = $latitude - ($radius / 69);
		$lat_max = $latitude + ($radius / 69);

		$sch = \App\Models\Schools::with('parent_all')->get();

		$rm = 3961; // mean radius of the earth (miles) at 39 degrees from the equator
		$rk = 6373; // mean radius of the earth (km) at 39 degrees from the equator

		// convert coordinates to radians
		$lat1 = deg2rad((float) $data->latitude);
		$lon1 = deg2rad((float) $data->longitude);

		foreach ($sch as $value) {
			foreach ($value->parent_all as $key) {
				$lat2 = deg2rad((float) $key->latitude);
				$lon2 = deg2rad((float) $key->longitude);
				$dlon = $lon2 - $lon1;
				$dlat = $lat2 - $lat1;
				// here's the heavy lifting
				$a = abs(pow(abs(sin($dlat / 2)), 2)) + abs(cos($lat1)) * abs(cos($lat2)) * abs(pow(abs(sin($dlon / 2)), 2));
				$c = 2 * abs(atan2(abs(sqrt($a)), abs(sqrt(1 - $a)))); // great circle distance in radians
				$dm = $c * $rm; // great circle distance in miles
				$dk = $c * $rk; // great circle distance in km
				// round the results down to the nearest 1/1000
				if (round($dk) < 2) {
					$schools[] = ['id' => $value->id, 'km' => round($dk), 'name' => $value->name];
				}
				$mi[] = ['miles' => round($dm), 'name' => $value->name];
			}
		}
		$postcode = \App\Models\Postcodes::with('addresses', 'busstops')->find($data->id);
		//$schools = $postcode->schools;
		$addresses = $postcode->addresses;
		$busstops = $postcode->busstops;
		/*

			$mat = \DB::table('postcodes')
			->selectRaw(" * , ASIN(SQRT(POWER(SIN(('{$latitude}' - ABS('postcodes.latitude')) * PI() / 180 / 2),2) + COS('{$latitude}' * PI() / 180) * COS(ABS('postcodes.latitude') * PI() / 180 * POWER(SIN(('{$longitude}' - 'postcodes.longitude') * PI() / 180 / 2),2))))  AS  distance ")
			->leftJoin('schools', 'postcodes.id', '=', 'schools.postcode_id')
			->whereBetween('postcodes.longitude', [$lng_min, $lng_max])
			->whereBetween('postcodes.latitude', [$lat_min, $lat_max])
			->whereNotNull('name')
			->having('distance', '<', $radius)
			->orderBy('distance', 'ASC')->get();

			           //	$postcodes = \App\Models\Postcodes::find($request->data);

				//	$ref = array($postcodes->latitude, $postcodes->longitude);

				//->selectRaw(" latitude, longitude ,(((ACOS(SIN(RADIANS('latitude')) * SIN(RADIANS({$postcodes->latitude})) + COS(RADIANS('latitude')) * COS(RADIANS({$postcodes->latitude})) * COS(RADIANS('longitude' - {$postcodes->longitude}))))*180/PI()) * 60 * 1.1515) AS distance")->get();

				//dd(\DB::getQueryLog(), $mi, $km, $schools->toArray());
				/**
				 * Get the colection of schools
				 *
				 * @return distances
		*/
		//	$distances = $schools->map(function ($item, $key) use ($ref) {
		//		$a = array_flatten(array_slice($item->toArray(), -2)); #if are latitude and longitude last two in the array return them
		//		return $this->distance($a, $ref); # calculate distance
		//	});
=======
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
>>>>>>> d5f0da9d32bef94b9c2def52f5374810da96c7b2

//	$distances->all();

		//	dd($ref, $distances, $schools->toArray());
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
