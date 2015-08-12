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
		$zipcode = $request->input('zipcode');

		$resultset = DB::table('cities')
	        ->join('states', 'cities.state_id', '=', 'states.id')
	        ->join('countries', function ($join)  use ($country_code){
	            $join->on('states.country_id', '=', 'countries.id')
                	 ->where('countries.code', '=', $country_code);
	        })
	        ->where('cities.zip_code', '=', $zipcode)
	        ->select('cities.*')
	        ->get();

	    $cities = Models\City::collectionFromResultset($resultset);
		$this->data->count = $cities->count();
		if($this->data->count == 1)
		{
			$city = $cities->first();
			$this->data->city_id = $city->id;
			$this->data->text = $city->name . " - " . $city->state->code . " - " . $city->zip_code;
		}
		else
		{
			$rows = [];
			foreach ($cities as $city)
			{
				$row = new \stdClass();
				$row->city_id = $city->id;
				$row->text = $city->name . " - " . $city->state->code . " - " . $city->zip_code;
				$rows[] = $row;
			}
			$this->data->rows = $rows;
		}

		return $this->json();
	}
}