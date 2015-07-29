<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Business;
use App\User;
use Illuminate\Http\Request;

class businessController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Define objet to be returned as a json string
        $data = new \stdClass();
        $data->success = false;
        // get all the businesses
        $data->businesses = Business::all();

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
        /*
      1. Validate that the input is properly formed
      2. Attempt to send email (and store data?)
      3. Respond with view or redirect
        */

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
          'url'         => $request->input('url')
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = new \stdClass();
        $data->business = Business::find($id);

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
