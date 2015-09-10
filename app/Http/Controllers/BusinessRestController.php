<?php namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Admin;
use App\Models\Business;
use App\Models\Country;

use App\Services\PaginateService;
use App\Services\UserService;
use App\Services\AdminService;
use App\Services\BusinessService;
use App\Services\LocationService;

class BusinessRestController extends Controller {

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
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $query = Business::where("owner_id", "=", $this->user->id);
        $paginate = new PaginateService($query);

        $this->data->success = true;
        $this->data->businesses = $paginate->data();
        $this->data->paging = $paginate->paging();

        return $this->json();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $success = false;

        $validation = BusinessService::validator(\Request::all());

        if ($validation->fails())
        {
            $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
            $admin = AdminService::getAdmin([
                'owner_id'      => $this->user->id,
                'email'         => $request->input('admin_email'),
                'first_name'    => $request->input('admin_first_name'),
                'last_name'     => $request->input('admin_last_name'),
                'id'            => ($request->input('new_admin') ? false : $request->input('admin_id')),
                'user_admin_id' => ($request->input('new_admin') == 2 ? $this->user->id : false)
            ]);

            $city = BusinessService::getCity([
                'city_id'      => ($request->input('new_city') ? false : $request->input('city_id')),
                'country_code' => $request->input('country_code'),
                'zip_code'     => ($request->input('new_city') ? $request->input('zip_code') : $request->input('city_zip_code')),
                'city_name'    => $request->input('city_name'),
                'state_name'   => $request->input('state_name')
            ]);

            $business = BusinessService::create([
                'business_type_id'     => $request->input('business_type_id'),
                'organization_type_id' => $request->input('organization_type_id'),
                'city_id'              => $city->id,
                'owner_id'             => $this->user->id,
                'admin_id'             => $admin->id,
                'name'                 => $request->input('name'),
                'description'          => $request->input('description'),
                'phone'                => $request->input('phone'),
                'url'                  => $request->input('url'),
                'address'              => $request->input('address')
            ]);

            $success = true;
            $this->data->business = $business;
        }
        $this->data->success = $success;
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
        if($business = Business::find($id))
        {
            $success = true;
        }
        else
        {
            $this->data->error = "Business not found";
            $success = false;
        }

        $this->data->success = $success;
        $this->data->business = $business;

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
        return $this->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $success = false;

        $validation = BusinessService::validator(\Request::all());

        if ($validation->fails())
        {
            $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
            $business = Business::find($id);

            $admin = AdminService::getAdmin([
                'owner_id'   => $this->user->id,
                'email'      => $request->input('admin_email'),
                'first_name' => $request->input('admin_first_name'),
                'last_name'  => $request->input('admin_last_name'),
                'id'         => ($request->input('new_admin') ? false : $request->input('admin_id')),
                'user_admin_id' => ($request->input('new_admin') == 2 ? $this->user->id : false)
            ]);

            $city = BusinessService::getCity([
                'city_id'      => ($request->input('new_city') ? false : $request->input('city_id')),
                'country_code' => $request->input('country_code'),
                'zip_code'     => ($request->input('new_city') ? $request->input('zip_code') : $request->input('city_zip_code')),
                'city_name'    => $request->input('city_name'),
                'state_name'   => $request->input('state_name')
            ]);

            $business = BusinessService::update($id, [
                'business_type_id'     => $request->input('business_type_id'),
                'organization_type_id' => $request->input('organization_type_id'),
                'city_id'              => $city->id,
                'owner_id'             => $this->user->id,
                'admin_id'             => $admin->id,
                'name'                 => $request->input('name'),
                'description'          => $request->input('description'),
                'phone'                => $request->input('phone'),
                'url'                  => $request->input('url'),
                'address'              => $request->input('address')
            ]);

            $success = true;
            $this->data->business = $business;
        }

        $this->data->success = $success;

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
        if($business = Business::find($id))
        {
            $this->data->business = $business->name;
            $business->delete();
            $success = true;
        }
        else
        {
            $this->data->error = "Business not found";
            $success = false;
        }

        $this->data->success = $success;

        return $this->json();
    }

}
