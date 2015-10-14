<?php namespace App\Http\Controllers;

use Auth;
use Validator;
use Redirect;
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
        \Debugbar::disable();
        $this->middleware('auth');
        $this->middleware('business.rights');

        $this->user = Auth::user();
    }

    /**
     * Show the application dashboard to the business admin.
     *
     * @return Response
     */
    public function getIndex(Business $business)
    {
        //return redirect('/dashbiz/link');
        //print_r($business->toArray());
        $this->data->business = $business;
        return $this->view('dashboard.business.index');
    }

    /**
     *
     *
     * @return Response
     */
    public function getEmail(Business $business, Request $request)
    {
        $this->data->business = $business;
        $this->data->config = $this->defaultConfig('email', $business, $request);

        return $this->view('dashboard.business.email');
    }

    /**
     *
     *
     * @return Response
     */
    public function postEmail(Business $business, Request $request)
    {
        $validator = Validator::make($request->all(), []);
        if ($validator->fails())
        {
            return Redirect::route('business.dashboard.email', $business)
                ->withErrors($validator)
                ->withInput();
        }

        $setting = $this->defaultConfig('email', $business, $request);
        $business->config->email = $setting;
        $business->save();

        return Redirect::back()->with('message', 'Email settings successfully saved');
    }

    /**
     *
     *
     * @return Response
     */
    public function getFeedback(Business $business, Request $request)
    {
        $this->data->business = $business;
        $this->data->config = $this->defaultConfig('feedback', $business, $request);
        $this->data->product = $business->products->first();

        return $this->view('dashboard.business.feedback');
    }

    /**
     *
     *
     * @return Response
     */
    public function postFeedback(Business $business, Request $request)
    {
        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return Redirect::route('business.dashboard.email', $business)
                ->withErrors($validator)
                ->withInput();
        }

        $feedback = $this->defaultConfig('feedback', $business, $request);
        // Only input type radio
        $feedback->include_social_links   = is_null($request->input('include_social_links')) ? false : true;
        $feedback->include_phone          = is_null($request->input('include_phone')) ? false : true;
        $business->config->feedback = $feedback;
        $business->save();

        return Redirect::back()->with('message', 'Feedback settings successfully saved');
    }

    public function getGallery(Business $business, Request $request)
    {
        $this->data->target = $request->input('target');
        $business->config->feedback = $this->defaultConfig('feedback', $business, $request);
        $this->data->images = $business->config->feedback->{$this->data->target . '_gallery'};
        return $this->json();
    }

    public function postImage(Business $business, Request $request)
    {
        $this->data->image = $request->input('image');
        $this->data->target = $request->input('target');
        $this->setImage($business, $this->data->target, $this->data->image, $request);
        return $this->json();
    }

    public function postUpload(Business $business, Request $request)
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
            $file_name = \Uuid::generate().'.'.$extension;
            $image->move($destination_path, $file_name);

            $file_url = url('uploads/' . $file_name);
            $this->setImage($business, $target, $file_url, $request);
            $this->data->image = $file_url;
            $success = true;
        } else {
            $this->data->errors = 'Uploaded file is not valid';
        }

        $this->data->success = $success;
        return $this->json();
    }

    private function setImage($business, $target, $image, $request)
    {
        $business->config->feedback = $this->defaultConfig('feedback', $business, $request);
        $business->config->feedback->{"{$target}_url"} = $image;
        if(!(strpos($image, url('uploads/')) === false))
        {
            $gallery = $business->config->feedback->{$target . '_gallery'};
            if(!in_array($image, $gallery))
            {
                $business->config->feedback->{$target . '_gallery'}[] = $image;
            }
        }
        $business->save();
    }

    /**
     *
     *
     * @return Response
     */
    public function getTestimonial(Business $business, Request $request)
    {
        $this->data->business = $business;
        $this->data->config   = $this->defaultConfig('testimonial', $business, $request);
        $this->data->product  = $business->products->first();

        return $this->view('dashboard.business.testimonial');
    }

    /**
     *
     *
     * @return Response
     */
    public function postTestimonial(Business $business, Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return Redirect::route('business.dashboard.testimonial', $business)
                ->withErrors($validator)
                ->withInput();
        }

        $setting = $this->defaultConfig('testimonial', $business, $request);
        // Only input type radio
        $setting->include_feedback = is_null($request->input('include_feedback')) ? false : true;
        $setting->include_likes = is_null($request->input('include_likes')) ? false : true;

        $business->config->testimonial = $setting;
        $business->save();

        return Redirect::back()->with('message', 'Testimonials settings successfully saved');
    }

    /**
     *
     *
     * @return Response
     */
    public function getNotification(Business $business, Request $request)
    {
        $this->data->business = $business;
        $this->data->config   = $this->defaultConfig('notification', $business, $request);

        return $this->view('dashboard.business.notification');
    }

    /**
     *
     *
     * @return Response
     */
    public function postNotification(Business $business, NotificationUpdateRequest $request)
    {
        $setting = $this->defaultConfig('notification', $business, $request);
        // Only input type radio
        $setting->send_to_owner = is_null($request->input('send_to_owner')) ? false : true;
        $setting->send_to_admin = is_null($request->input('send_to_admin')) ? false : true;
        $setting->alert_positive = is_null($request->input('alert_positive')) ? false : true;
        $setting->alert_negative = is_null($request->input('alert_negative')) ? false : true;
        $setting->send_alerts = is_null($request->input('send_alerts')) ? false : true;

        $business->config->notification = $setting;
        $business->save();

        return Redirect::back()->with('message', 'Notification settings successfully saved');
    }

    /**
     * Links page in dashboard business.
     *
     * @return Response
     */
    public function getLinks(Business $business)
    {
        $this->data->business = $business;
        $this->data->social_networks = SocialNetwork::all();
        return $this->view('dashboard.crud.business.link.index');
    }

    private function defaultConfig($type, $business, $request)
    {
        return BusinessService::defaultConfig($type, $business, $request);
    }

}
