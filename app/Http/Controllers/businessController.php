<?php namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Business;
use App\Models\Country;

class BusinessController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();
        $this->data->success = true;
        $this->data->businesses = Business::where("owner_id", "=", $user->id)->get()->toArray();
        return $this->json();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        /*
          1. Validate that the input is properly formed
          2. Attempt to send email (and store data?)
          3. Respond with view or redirect
        */

        // Define objet to be returned as a json string
        $this->data->success = false;
        $this->data->errors = array();

        $user = \Auth::user();

        // Validation rules to aply to fields
        $rules = array(
            'name'                  => 'required',
            'url'                   => 'required|url',
            'organization_type_id'  => 'required',
            'business_type_id'      => 'required',

            'admin_id'              => 'required_if:new_admin,0',
            'admin_first_name'      => 'required_if:new_admin,1',
            'admin_last_name'       => 'required_if:new_admin,1',
            'admin_email'           => 'required_if:new_admin,1',

            'country_code'          => 'required',
            'city_id'               => 'required_if:new_city,0',
            'cityname'              => 'required_if:new_city,1',
            'state'                 => 'required_if:new_city,1',
            'zipcode'               => 'required_if:new_city,1',
            'cityname'              => 'required_if:new_city,1',
            'address'               => 'required'
        );

        // Instantiate validator using received post parameters and setted rules
        $validation = \Validator::make(\Request::all(), $rules);

        if ($validation->fails())
        {
          $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
            if($request->input('new_admin') == 1)
            {
                $user_admin_email = $request->input('admin_email');
                if($users = User::where('email','=',$user_admin_email)->get())
                {
                    $user_admin = $users->first();
                }
                else
                {
                    $user_admin = new User;
                    $user_admin->first_name = $request->input('admin_first_name');
                    $user_admin->last_name = $request->input('admin_last_name');
                    $user_admin->email = $user_admin_email;
                    $user_admin->password = str_random(6);
                    $user_admin->activation_code = str_random(60);
                    $user_admin->save();
                }
    
                if($user_admin->isAdmin())
                {
                    $admin = $user_admin->admin;
                }
                else
                {
                    $admin = new Admin;
                    $admin->owner_id = $user->owner->id;
                    $admin->user_id = $user_admin->id;
                    $admin->save();
                }
                $admin_id = $admin->id;
            }
            else
            {
                $admin_id = $request->input('admin_id');
            }

            $business = new Business;
            $business->owner_id = $user->owner->id;
            $business->admin_id = $admin_id;
            $business->organization_type_id = $request->input('organization_type_id');
            $business->business_type_id = $request->input('business_type_id');
            $business->name = $request->input('name');
            $business->description = $request->input('description');
            $business->phone = $request->input('phone');
            $business->url = $request->input('url');

            $country = Country::where("code","=",$request->input('country_code'))->get();
            $business->country_id = $country->id;

            if($request->input('new_city') == 1)
            {
                $business->cityname = $request->input('cityname');
                $business->state = $request->input('state');
                $business->zipcode = $request->input('zipcode');
            }
            else
            {
                $business->city_id = $request->input('city_id');
            }
            $business->address = $request->input('address');

            // store new biz
            $business->save();
            //Session::flash('message', 'Successfully created!');
            $this->data->success = true;
            $this->data->business = $business->toArray();
        }
        return $this->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->data->business = Business::find($id);

        return $this->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $success = false;
        if($business = Business::find($id))
        {
            $success = true;
        }

        $this->data->success = $success;
        $this->data->business = $business;
        $this->data->_token = csrf_token();

        return $this->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->data->id = $id;
        $this->data->business = $request;

        return $this->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
