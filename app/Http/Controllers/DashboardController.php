<?php namespace App\Http\Controllers;

Use App\Models;


class DashboardController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

		$this->data->user = \Auth::user();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->view('dashboard');
	}

	/**
	 * Businesses page in dashboard.
	 *
	 * @return Response
	 */
	public function business()
	{
		$this->data->organization_types = Models\OrganizationType::all();
		$this->data->business_types = Models\BusinessType::all();
		$this->data->countries = Models\Country::all();

		return $this->view('business');
	}

	/**
	 * 
	 *
	 * @return Response
	 */
	public function account()
	{
		return $this->view('account');
	}

	/**
	 * 
	 *
	 * @return Response
	 */
	public function widgets()
	{
		return $this->view('widgets');
	}
	/**
	 * 
	 *
	 * @return Response
	 */
	public function reports()
	{
		return $this->view('reports');
	}
	/**
	 * 
	 *
	 * @return Response
	 */
	public function help()
	{
		return $this->view('help');
	}

}
