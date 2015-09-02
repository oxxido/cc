<?php namespace App\Http\Controllers;

use Auth;
use Validator;
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
    public function getTest()
    {
        $this->data->business = $this->business;
        return $this->json();
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
    public function getFeedback(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config = $this->defaultFeedbackConfig($this->business, $request);
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

        $feedback = $this->defaultFeedbackConfig($this->business, $request);
        $feedback->includeSocialLinks = $request->input('includeSocialLinks');
        $feedback->includePhone       = $request->input('includePhone');
        $feedback->positiveThreshold  = $request->input('positiveThreshold');
        $feedback->pageTitle          = $request->input('pageTitle');
        $feedback->logoUrl            = $request->input('logoUrl');
        $feedback->bannerUrl          = $request->input('bannerUrl');
        $feedback->starsStyle         = $request->input('starsStyle');

        $this->business->config->feedback = $feedback;
        $this->business->save();

        $this->data->saved = true;
        $this->data->business = $this->business;
        $this->data->config = $this->business->config->feedback;

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

    private function defaultFeedbackConfig($business, $request)
    {
        $feedback = isset($business->config->feedback) ? $business->config->feedback : new \stdClass;
        $default = [
            'includeSocialLinks' => true,
            'includePhone'       => false,
            'positiveThreshold'  => 3,
            'pageTitle'          => $business->name,
            'logoUrl'            => asset('images/logo-example.png'),
            'bannerUrl'          => asset('images/landscape.jpg'),
            'starsStyle'         => 'default'
        ];
        foreach($default as $name => $value)
        {
            $feedback->$name = ($request->old($name) && $request->old($name) !== false) ? $request->old($name) : ((isset($feedback->$name) && $feedback->$name) ? $feedback->$name : $default[$name]);
        }

        //echo "<pre>"; var_dump($feedback); exit();
        return $feedback;
    }
}
