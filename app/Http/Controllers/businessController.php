<?php namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Business;
use App\Models\Country;

use App\Services\UserService;
use App\Services\AdminService;
use App\Services\BusinessService;
use App\Services\LocationService;

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
        $this->data->success = false;
        $this->data->errors = array();

        $user = \Auth::user();

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
            'city_name'              => 'required_if:new_city,1',
            'state'                 => 'required_if:new_city,1',
            'zip_code'               => 'required_if:new_city,1',
            'city_name'              => 'required_if:new_city,1',
            'address'               => 'required'
        );

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
                if(!($user_admin = UserService::find($user_admin_email)))
                {
                    $password = str_random(8);
                    $user_admin = UserService::create([
                        'first_name' => $request->input('admin_first_name'),
                        'last_name' => $request->input('admin_last_name'),
                        'email' => $user_admin_email,
                        'password' => $password,
                        'password_confirmation' => $password
                    ]);
                }

                if($user_admin->isAdmin($user->id))
                {
                    $admin = $user_admin->admin;
                }
                else
                {
                    $admin = AdminService::create([
                        'owner_id' => $user->id,
                        'admin_id' => $user_admin->id
                    ]);
                }
                $admin_id = $admin->id;
            }
            else
            {
                $admin_id = $request->input('admin_id');
            }

            $city_id = $request->input('city_id');
            $country_code = $request->input('country_code');
            $zip_code = $request->input('zip_code');
            if(!($city = LocationService::find($city_id, $zip_code, $country_code)->first()))
            {
                $city = LocationService::create([
                    'city_name'    => $request->input('city_name'),
                    'state_name'   => $request->input('state_name'),
                    'country_code' => $country_code,
                    'zip_code'     => $zip_code
                ]);
            }

            $business = BusinessService::create([
                'business_type_id'     => $request->input('business_type_id'),
                'organization_type_id' => $request->input('organization_type_id'),
                'city_id'              => $city->id,
                'owner_id'             => $user->id,
                'admin_id'             => $admin_id,
                'name'                 => $request->input('name'),
                'description'          => $request->input('description'),
                'phone'                => $request->input('phone'),
                'url'                  => $request->input('url'),
                'address'              => $request->input('address')
            ]);

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
