<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models;

class DashboardBusinessController extends Controller {


    public $user;
    public $business = false;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

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
        return redirect('/dashbiz/link');
    }

    /**
     * Link page in dashboard business.
     *
     * @return Response
     */
    public function getLink()
    {
        $this->data->social_networks = Models\SocialNetwork::all();        
        return $this->view('dashboard.crud.link.index');
    }

    /**
     * Show the application dashboard to the business admin.
     *
     * @return Response
     */
    public function getLoad($id = false)
    {
        $this->setBusiness($id);
        return redirect("dashbiz");
    }

    private function setBusiness($id = false)
    {
        $id_session = \Session::get('business_id');
        $id_default = false;

        if($this->user->isOwner())
        {
            if($business = $this->user->owner->businesses->first())
                $id_default = $business->id;
        }
        else
        {
            if(($admin = $this->user->admin()->first()) && ($business = $admin->businesses->first()))
                $id_default = $business->id;
        }

        $id = $id ? $id : ($id_session ? $id_session : ($id_default ? $id_default : false));

        if($id && $business = Business::find($id))
        {
            $this->business = $business;
            \Session::set('business_id', $id);
        }
    }
}
