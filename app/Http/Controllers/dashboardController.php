<?php namespace App\Http\Controllers;

Use App\Users;
Use App\Business;

class DashboardController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [];
		$data['user'] = \Auth::user();
		return view('dashboard', $data);
	}

	/**
	 * Businesses page in dashboard.
	 *
	 * @return Response
	 */
	public function business()
	{
		$data = [];
		$data['user'] = \Auth::user();
		return view('business', $data);
	}

	/**
	 * 
	 *
	 * @return Response
	 */
	public function account()
	{
		$data = [];
		$data['user'] = \Auth::user();
		return view('account', $data);
	}

	/**
	 * 
	 *
	 * @return Response
	 */
	public function widgets()
	{
		$data = [];
		$data['user'] = \Auth::user();
		return view('widgets', $data);
	}
	/**
	 * 
	 *
	 * @return Response
	 */
	public function reports()
	{
		$data = [];
		$data['user'] = \Auth::user();
		return view('reports', $data);
	}
	/**
	 * 
	 *
	 * @return Response
	 */
	public function help()
	{
		$data = [];
		$data['user'] = \Auth::user();
		return view('help', $data);
	}

}
