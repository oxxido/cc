<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Business;

class DashboardBusinessController extends Controller {


	public $user;
	public $business;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

		$this->user = Auth::user();
		$this->data->user = $this->user;
		$this->setBusiness();
	}

	/**
	 * Show the application dashboard to the business admin.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$this->data->business = $this->user->admin()->first()->businesses;
		return $this->view('dashboard.business.index');
	}

	private function setBusiness($id = false)
	{
		$id_session = \Session::get('business_id');
		$id_default = $this->user->admin()->first()->businesses->first()->id;
		$id = $id ? $id : ($id_session ? $id_session : $id_default);
		$this->business = Business::find($id);
	}
}
