<?php namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Services\BusinessService;
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
    public function getTest()
    {
        print_r($this->business->products->first()->hash);
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
    public function getTestimonial(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config = $this->defaultConfig('testimonial', $request);
        $this->data->product = $this->business->products->first();
        return $this->view('dashboard.business.testimonial');
    }

    /**
     * 
     *
     * @return Response
     */
    public function postTestimonial(Request $request)
    {
        $validator = Validator::make($request->all(), array());

        if ($validator->fails())
        {
            return redirect('dashbiz/testimonial')
                ->withErrors($validator)
                ->withInput();
        }

        $setting = $this->defaultConfig('testimonial', $request);
        // Only input type radio
        $setting->includeFeedback = $request->input('includeFeedback');
        $this->business->config->testimonial = $setting;
        $this->business->save();

        $this->data->saved = true;
        $this->data->business = $this->business;
        $this->data->config = $this->business->config->testimonial;
        $this->data->product = $this->business->products->first();

        return $this->view('dashboard.business.testimonial');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getNotification(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config = $this->defaultConfig('notification', $request);
        return $this->view('dashboard.business.notification');
    }

    /**
     * 
     *
     * @return Response
     */
    public function postNotification(Request $request)
    {
        return $this->view('dashboard.business.notification');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getEmail(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config = $this->defaultConfig('email', $request);
        return $this->view('dashboard.business.email');
    }

    /**
     * 
     *
     * @return Response
     */
    public function postEmail(Request $request)
    {
        return $this->view('dashboard.business.email');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getKiosk(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config = $this->defaultConfig('kiosk', $request);
        return $this->view('dashboard.business.kiosk');
    }

    /**
     * 
     *
     * @return Response
     */
    public function postKiosk(Request $request)
    {
        return $this->view('dashboard.business.kiosk');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getFeedback(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config = $this->defaultConfig('feedback', $request);
        $this->data->product = $this->business->products->first();
        return $this->view('dashboard.business.feedback');
    }

    /**
     * 
     *
     * @return Response
     */
    public function postFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'pageTitle' => 'required',
            'logoUrl'   => 'required',
            'bannerUrl' => 'required'
        ));

        if ($validator->fails())
        {
            return redirect('dashbiz/feedback')
                ->withErrors($validator)
                ->withInput();
        }

        $feedback = $this->defaultConfig('feedback', $request);
        // Only input type radio
        $feedback->includeSocialLinks = $request->input('includeSocialLinks');
        $feedback->includePhone       = $request->input('includePhone');
        $this->business->config->feedback = $feedback;
        $this->business->save();

        $this->data->saved = true;
        $this->data->business = $this->business;
        $this->data->config = $this->business->config->feedback;
        $this->data->product = $this->business->products->first();

        return $this->view("dashboard.business.feedback");
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

    private function defaultConfig($type, $request)
    {
        return BusinessService::defaultConfig($type, $this->business, $request);
    }
}
