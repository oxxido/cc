<?php namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models;

class LocationController extends Controller {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getZipcode(Request $request)
	{
		$country_code = $request->input('country_code');
		$zip_code = $request->input('zip_code');

		$cities = Models\City::join('states', 'cities.state_id', '=', 'states.id')
	        ->join('countries', function ($join)  use ($country_code){
	            $join->on('states.country_id', '=', 'countries.id')
                	 ->where('countries.code', '=', $country_code);
	        })
	        ->where('cities.zip_code', '=', $zip_code)
	        ->select('cities.*')
	        ->get();

		$this->data->count = $cities->count();
		if($this->data->count == 1)
		{
			$city = $cities->first();
			$this->data->city_id = $city->id;
			$this->data->location = $city->location;
		}
		else
		{
			$this->data->rows = $cities;
		}

		return $this->json();
	}
}