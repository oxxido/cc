<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models;

class DashboardOwnerController extends Controller {

    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \Debugbar::disable();

        $this->middleware('auth');
        $this->middleware('owner');

        $this->user = Auth::user();;
        $this->data->user = $this->user;
    }

    /**
     * Show the application dashboard to the owner site.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
        $request->session()->reflash();
        return redirect('dashowner/business');
        return $this->view('dashboard.owner.index');
    }

    /**
     * Businesses page in dashboard.
     *
     * @return Response
     */
    public function getBusiness()
    {
        $this->data->organization_types = Models\OrganizationType::all();
        $this->data->business_types = Models\BusinessType::all();
        $this->data->countries = Models\Country::all();
        $resultset = DB::table('admins')
            ->join('users', 'admins.admin_id', '=', 'users.id')
            ->where('admins.owner_id', '=', $this->user->id)
            ->select('admins.*')
            ->get();
        $this->data->admins =  Models\Admin::collectionFromArray($resultset);

        return $this->view('dashboard.crud.business.index');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getAdmins()
    {
        return $this->view('dashboard.crud.admin.index');
    }

    /**
     * Search Business Admin by keyword and Owner.
     *
     * @return Response
     */
    public function getSearchadmin(Request $request)
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

        $users = Models\Admin::collectionFromArray($resultset);
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
