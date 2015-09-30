<?php namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NotificationUpdateRequest;
use App\Services\BusinessService;
use App\Models\Business;
use App\Models\SocialNetwork;


class DashboardBusinessController extends Controller {

    public $user;

    public $business = false;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //\Debugbar::disable();
        $this->middleware('auth');
        $this->middleware('admin');

        $this->user       = Auth::user();
        $this->data->user = $this->user;

        if ($this->user) {
            $this->setBusiness();
        }
        $this->data->business_id = \Session::get('business_id');
        $this->data->business = $this->business;
        
        if($this->business == false)
        {
            return new RedirectResponse(url('/dashboard'));
        }
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
    public function getIndex(Request $request)
    {
        $request->session()->reflash();
        return redirect('dashbiz/link');
        return $this->view('dashboard.dashboardAdmin');
    }

    /**
     * Link page in dashboard business.
     *
     * @return Response
     */
    public function getLink()
    {
        $this->data->social_networks = SocialNetwork::all();

        return $this->view('dashboard.crud.link.index');
    }

    /**
     *
     *
     * @return Response
     */
    public function getTestimonial(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config   = $this->defaultConfig('testimonial', $request);
        $this->data->product  = $this->business->products->first();

        return $this->view('dashboard.business.testimonial');
    }

    /**
     *
     *
     * @return Response
     */
    public function postTestimonial(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect('dashbiz/testimonial')->withErrors($validator)->withInput();
        }

        $setting = $this->defaultConfig('testimonial', $request);
        // Only input type radio
        $setting->include_feedback = is_null($request->input('include_feedback')) ? false : true;
        $setting->include_likes = is_null($request->input('include_likes')) ? false : true;

        $this->business->config->testimonial = $setting;
        $this->business->save();

        $this->data->saved    = true;
        $this->data->business = $this->business;
        $this->data->config   = $this->business->config->testimonial;
        $this->data->product  = $this->business->products->first();

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
        $this->data->config   = $this->defaultConfig('notification', $request);

        return $this->view('dashboard.business.notification');
    }

    /**
     *
     *
     * @return Response
     */
    public function postNotification(NotificationUpdateRequest $request)
    {
        $notifications = $request->all();
        unset($notifications['_token']);
        $notification = BusinessService::getConfig('notification', $request);
        $this->business->config->notification = $notification;
        $this->business->save();
        return \Redirect::back();
    }

    /**
     *
     *
     * @return Response
     */
    public function getEmail(Request $request)
    {
        $this->data->business = $this->business;
        $this->data->config   = $this->defaultConfig('email', $request);

        return $this->view('dashboard.business.email');
    }

    /**
     *
     *
     * @return Response
     */
    public function postEmail(Request $request)
    {
        $validator = Validator::make($request->all(), array());
        if ($validator->fails())
        {
            return redirect('dashbiz/email')
                ->withErrors($validator)
                ->withInput();
        }

        $setting = $this->defaultConfig('email', $request);
        $this->business->config->email = $setting;
        $this->business->save();

        $this->data->saved = true;
        $this->data->business = $this->business;
        $this->data->config = $this->business->config->email;
        $this->data->product = $this->business->products->first();
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
        $this->data->config   = $this->defaultConfig('kiosk', $request);

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
        $this->data->config   = $this->defaultConfig('feedback', $request);
        //echo "<pre>";print_r($this->data->config); exit();
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
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect('dashbiz/feedback')->withErrors($validator)->withInput();
        }

        $feedback = $this->defaultConfig('feedback', $request);
        // Only input type radio
        $feedback->include_social_links   = is_null($request->input('include_social_links')) ? false : true;
        $feedback->include_phone          = is_null($request->input('include_phone')) ? false : true;
        $this->business->config->feedback = $feedback;
        $this->business->save();

        $this->data->saved    = true;
        $this->data->business = $this->business;
        $this->data->config   = $this->business->config->feedback;
        $this->data->product  = $this->business->products->first();

        return $this->view("dashboard.business.feedback");
    }

    public function getGallery(Request $request)
    {
        $this->data->target = $request->input('target');
        $this->business->config->feedback = $this->defaultConfig('feedback', $request);
        $this->data->images = $this->business->config->feedback->{$this->data->target . '_gallery'};
        return $this->json();
    }

    public function postImage(Request $request)
    {
        $this->data->image = $request->input('image');
        $this->data->target = $request->input('target');
        $this->setImage($this->data->target, $this->data->image, $request);
        return $this->json();
    }

    public function postUpload(Request $request)
    {
        $success = false;
        $target = $request->input('target');
        $image = $request->file($target);
        $validator = Validator::make(['image' => $image], ['image' => 'required|image|max:5120']);
        if ($validator->fails()) {
            $this->data->errors = $validator->getMessageBag()->toArray();
        } elseif ($image->isValid()) {
            $destination_path = public_path() . '/uploads';
            $extension = $image->getClientOriginalExtension();
            $file_name = microtime(true).'.'.$extension;
            $image->move($destination_path, $file_name);

            $file_url = url('uploads/' . $file_name);
            $this->setImage($target, $file_url, $request);
            $this->data->image = $file_url;
            $success = true;
        } else {
            $this->data->errors = 'Uploaded file is not valid';
        }

        $this->data->success = $success;
        return $this->json();
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

        if ($this->user->isOwner()) {
            if ($business = $this->user->owner->businesses->first()) {
                $id_default = $business->id;
            }
        } else {
            if (($admin = $this->user->admin()->first()) && ($business = $admin->businesses->first())) {
                $id_default = $business->id;
            }
        }

        $id = $id ? $id : ($id_session ? $id_session : ($id_default ? $id_default : false));

        if ($id && $business = Business::find($id)) {
            $this->business = $business;
            \Session::set('business_id', $id);
        }
    }

    private function defaultConfig($type, $request)
    {
        return BusinessService::defaultConfig($type, $this->business, $request);
    }

    private function setImage($target, $image, $request)
    {
        $this->business->config->feedback = $this->defaultConfig('feedback', $request);
        $this->business->config->feedback->{"{$target}_url"} = $image;
        if(!(strpos($image, url('uploads/')) === false))
        {
            $gallery = $this->business->config->feedback->{$target . '_gallery'};
            if(!in_array($image, $gallery))
            {
                $this->business->config->feedback->{$target . '_gallery'}[] = $image;
            }
        }
        $this->business->save();
    }

}
