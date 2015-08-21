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

		return $this->view('dashboard.business.index');
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
		return $this->view('dashboard.admin.index');
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

        $resultset = DB::table('admins')
        	->join('users', 'admins.admin_id', '=', 'users.id')
        	->where('admins.owner_id', '=', $this->user->id)
            ->where(function ($query) use ($keyword) {
	            $query->where('users.first_name', 'like', "% $keyword%")
	            	->orWhere('users.first_name', 'like', "$keyword%")
	            	->orWhere('users.last_name', 'like', "$keyword%")
	            	->orWhere('users.last_name', 'like', "% $keyword%")
	            	->orWhere('users.email', 'like', "%$keyword%@%");
            })
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
