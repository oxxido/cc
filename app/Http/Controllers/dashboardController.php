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

}
