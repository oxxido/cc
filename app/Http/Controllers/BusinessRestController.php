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
        \Debugbar::disable();
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

    public function csv(Request $request)
    {
        $upload = $request->file('csv');
        $validator = \Validator::make(['csv' => $upload], [
            'csv' => 'required|max:3072'
        ],[
            'csv.required' => 'File is required',
            'csv.max' => 'Max file size is 3MB'
        ]);

        if ($validator->fails())
        {
            $this->data->errors = $validator->getMessageBag()->toArray();
        }
        elseif (!$upload->isValid())
        {
            $this->data->errors = 'Uploaded file is not valid';
        }
        elseif(!in_array($upload->getClientMimeType(), explode(",", "csv,txt,text/csv,xls,application/vnd.ms-excel")))
        {
            $this->data->errors = 'Soported files are CSV (comma separated values) or XSL e.g. Excel. (Uploaded: '. $upload->getClientMimeType().')';
        }
        else
        {
            $tmp = (microtime(true)*1000) . '.' . $upload->getClientOriginalExtension();
            $path = storage_path("app/");
            $upload->move($path, $tmp);
            $tmp_path = $path.$tmp;

            $csv = \Excel::load($tmp_path);
            $lines = $csv->get();

            $heading = "name,description,phone,url,address,city,zip_code,state,state_code,country,country_code,admin_first_name,admin_last_name,admin_email";
            if(array_keys($csv->first()->toArray()) !== explode(",", $heading))
            {
                $this->data->errors = "Invalid format file. Check example file for CSV and XLS";
            }
            else
            {
                $results = [];

                foreach ($lines as $line)
                {
                    $validator = \Validator::make($line->toArray(), [
                        'name'             => 'required',
                        'url'              => 'required|url',
                        'address'          => 'required',
                        'city'             => 'required_if:zip_code,null',
                        'zip_code'         => '',
                        'country'          => '',
                        'country_code'     => '',
                        'admin_first_name' => 'required',
                        'admin_last_name'  => 'required',
                        'admin_email'      => 'required|email'
                    ]);
                    $validator->sometimes('state', 'required', function($input) use ($line) {
                        return (!$line->zip_code && !$line->state_code);
                    });
                    $validator->sometimes('state_code', 'required', function($input) use ($line) {
                        return (!$line->zip_code && !$line->state);
                    });
                    $errors = $validator->getMessageBag()->toArray();
                    $logs = [];

                    $admin = AdminService::getAdmin([
                        'owner_id'   => $this->user->id,
                        'email'      => $line->admin_email,
                        'first_name' => $line->admin_first_name,
                        'last_name'  => $line->admin_last_name
                    ], $logs);

                    if(!$admin)
                    {
                        $errors[] = "Admin not found or not created";
                    }

                    $city = BusinessService::getCity([
                        'city_name'    => $line->city,
                        'zip_code'     => $line->zip_code,
                        'state_name'   => $line->state,
                        'state_code'   => $line->state_code,
                        'country_name' => $line->country,
                        'country_code' => $line->country_code
                    ]);
                    if(!$city)
                    {
                        $errors[] = "City not found or not created";
                    }

                    $result = new \stdClass;
                    $result->line = $line;
                    if(count($errors))
                    {
                        $result->errors = $errors;
                    }
                    else
                    {
                        $business = BusinessService::create([
                            'city_id'     => $city->id,
                            'owner_id'    => $this->user->id,
                            'admin_id'    => $admin->id,
                            'name'        => $line->name,
                            'description' => $line->description,
                            'phone'       => $line->phone,
                            'url'         => $line->url,
                            'address'     => $line->address
                        ]);
                        $result->business = $business;
                    }
                    $result->logs = $logs;
                    $results[] = $result;
                }
                $this->data->results = $results;
            }

            \Storage::delete($tmp);
        }
        return $this->json();
    }
}
