<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LocationService;

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

		$cities = LocationService::find([
			'zip_code' => $zip_code,
			'country_code' => $country_code
		]);

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