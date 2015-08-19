<?php namespace App\Http\Controllers;

use DB;
use App\Models;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;

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
	public function manageUsers()
	{
        $this->data->countries = Models\Country::all();
		return $this->view('manageUsers');
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

    /**
     * Search Business Admin by keyword and Owner.
     *
     * @return Response
     */
    public function searchAdmin(Request $request)
    {
        $keyword = $request->input('keyword');
        $owner_id = \Auth::user()->owner->id;

        $resultset = DB::table('admins')
            ->join('users', function ($join)  use ($owner_id){
                $join->on('admins.user_id', '=', 'users.id')
                     ->where('admins.owner_id', '=', $owner_id);
            })
            ->where('users.first_name', 'like', "$keyword%")
            ->orwhere('users.first_name', 'like', "% $keyword%")
            ->orWhere('users.last_name', 'like', "$keyword%")
            ->orWhere('users.last_name', 'like', "% $keyword%")
            ->orWhere('users.email', 'like', "%$keyword%")
            ->select('admins.*')
            ->get();

        $users = Admin::collectionFromArray($resultset);
        $this->data->count = $users->count();
        if($this->data->count == 1)
        {
            $city = $users->first();
            $this->data->admin = $users->first();
        }
        else
        {
            $this->data->admins = $users;
        }
		unset($this->data->user);
        return $this->json();
    }

}
