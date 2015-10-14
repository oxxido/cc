<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Services\PaginateService;

class AdminRestController extends Controller {

    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->user = \Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $query = User::join('admins', 'users.id', '=', 'admins.admin_id')
            ->where('admins.owner_id', $this->user->id)
            ->where('users.id', "!=",$this->user->id);
        $paginate = new PaginateService($query);

        $this->data->success = true;
        $this->data->admins = $paginate->data();
        $this->data->paging = $paginate->paging();

        return $this->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $success = false;

        $validation = AdminService::validator(\Request::all());

        if ($validation->fails())
        {
            $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
            $admin = AdminService::getAdmin([
                'owner_id'   => $this->user->id,
                'email'      => $request->input('email'),
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name')
            ]);
            $this->data->admin = $admin;
            $success = true;
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
        if($admin = Admin::find($id))
        {
            $success = true;
        }
        else
        {
            $this->data->error = "User not found";
            $success = false;
        }

        $this->data->success = $success;
        $this->data->admin = $admin;

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

        $validation = AdminService::validator(\Request::all());

        if ($validation->fails())
        {
            $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
            $user_admin = Admin::find($id)->user;
            $user_admin->first_name = $request->input('first_name');
            $user_admin->last_name = $request->input('last_name');
            $user_admin->email = $request->input('email');
            $user_admin->save();

            $success = true;
            $this->data->admin = $user_admin->admin($this->user->id);
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

        if($admin = Admin::find($id))
        {
            foreach ($admin->businesses as $business)
            {
                if(!($new_admin = $business->owner->admin))
                {
                    $new_admin = AdminService::create([
                        'owner_id' => $business->owner->id,
                        'admin_id' => $business->owner->id
                    ]);
                }
                $business->admin_id = $new_admin->id;
                $business->save();
            }
            $this->data->admin = $admin->name;
            $admin->delete();
            $success = true;
        }
        else
        {
            $this->data->error = "User not found";
            $success = false;
        }

        $this->data->success = $success;

        return $this->json();
    }

}
