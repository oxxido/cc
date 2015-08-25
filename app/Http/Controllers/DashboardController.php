<?php namespace App\Http\Controllers;

use DB;
use App\Models;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;

class DashboardController extends Controller {


	public $user;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

		$this->user = \Auth::user();
		$this->data->user = $this->user;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if($this->user->isOwner())
		{
			return redirect('/dashowner');
		}
		elseif($this->user->isAdmin())
		{
			return redirect('/dashbiz');
		}
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
