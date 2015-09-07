<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller {

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
        $this->data->success = true;
        $this->data->admins = $this->user->admins();
        return $this->json();

        // Define objet to be returned as a json string
        $data = new \stdClass();
        $data->success = true;
        // get all the users
        $data->users = User::all();

        return \Response::json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Define objet to be returned as a json string
        $data = new \stdClass();
        $data->success = false;
        $data->error = "Not allowed";

        return \Response::json($data);
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
            $user = UserService::getUser([
                'first_name' => $request->input('user_first_name'),
                'last_name'  => $request->input('user_last_name'),
                'email'      => $request->input('user_email'),
            ]);
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
        $data = new \stdClass();
        $data->user = User::find($id);

        return \Response::json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // get the user
        $user = User::find($id);

        // Define objet to be returned as a json string
        $data = new \stdClass();
        $data->success = false;
        $data->errors = array();
        $user = User::find($request->input('user_id'));
        // Fields to get from form
        $business_data = array(
          'name'        => $request->input('name'),
          'description' => $request->input('description'),
          'telephone'   => $request->input('phone'),
          'address'     => $request->input('address'),
          'link'        => $request->input('url')
        );

        // Validation rules to aply to fields
        $rules = array(
          'name'    => 'required',
          'url' => 'required|url'
        );

        // Instantiate validator using received post parameters and setted rules
        $validation = \Validator::make(\Request::all(), $rules);

        if ($validation->fails()) {
          $data->errors = $validation->getMessageBag()->toArray();
        } else {
          // store new biz
            $business = new Business($business_data);
            $business->users_id = $user->id;
            $business->save();
            //Session::flash('message', 'Successfully created!');
            $data->success = true;
            $data->business = $business->toArray();
        }
        return \Response::json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        // get the user
        $id = $request->input('user_id');
        $success = false;

        // Fields to get from form
        $User_data = array(
          'first_name'        => $request->input('first_name'),
          'last_name'        => $request->input('last_name'),
          'email'       => $request->input('email'),
        );

        // Validation rules to aply to fields        
        $rules = array(
          'first_name'            => 'required',
          'last_name'             => 'required'
        );        

        if($request->input('password') && $request->input('password_confirmation')) {
            $User_data['password'] = $request->input('password');
            $rules['password'] = "required|min:6|confirmed";
            $rules['password_confirmation'] = "required|min:6";
        }
        // Instantiate validator using received post parameters and setted rules
        $validation = \Validator::make(\Request::all(), $rules);

        if ($validation->fails()) {
          $this->data->errors = $validation->getMessageBag()->toArray();
        } else {
            $user = User::find($id);

            $user = UserService::update($id, [
                'first_name'    => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
                'password'      => bcrypt($request->input('password'))
            ]);

            $success = true;
            $this->data->user = $user;
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
        //
    }

}
