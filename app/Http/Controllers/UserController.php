<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
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
        // Define objet to be returned as a json string
        $data = new \stdClass();
        $data->success = false;
        $data->error = "Not allowed";

        return \Response::json($data);
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
    public function update($id)
    {
        // get the user
        $user = User::find($id);

        // Define objet to be returned as a json string
        $data = new \stdClass();
        $data->success = false;
        $data->errors = array();

        // Fields to get from form
        $User_data = array(
          'name'        => $request->input('name'),
          'email'       => $request->input('email'),
        );

        // Validation rules to aply to fields
        $rules = array(
          'name'    => 'required',
          'email' => 'required|email'
        );

        if($request->input('password') && $request->input('password_confirmation')) {
            $User_data['password'] = $request->input('password');
            $rules['password'] = "required|min:6|confirmed";
            $rules['password_confirmation'] = "required|min:6";
        }
        // Instantiate validator using received post parameters and setted rules
        $validation = \Validator::make(\Request::all(), $rules);

        if ($validation->fails()) {
          $data->errors = $validation->getMessageBag()->toArray();
        } else {
          // store new biz
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            //Session::flash('message', 'Successfully created!');
            $data->success = true;
            $data->user = $user->toArray();
        }
        return \Response::json($data);
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
