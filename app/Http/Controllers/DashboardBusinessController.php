<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Business;

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

        if($this->user)
            $this->setBusiness();
        $this->data->businessId = \Session::get('business_id');

    }

    /**
     * Show the application dashboard to the business admin.
     *
     * @return Response
     */
    public function getIndex()
    {
        $this->data->business = $this->business->toArray();
        return $this->view('dashboard.business.index');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getTestimonial()
    {
        $this->data->business = $this->business->toArray();
        return $this->view('dashboard.business.testimonial');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getFeedback()
    {
        $this->data->business = $this->business->toArray();
        return $this->view('dashboard.business.feedback');
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
