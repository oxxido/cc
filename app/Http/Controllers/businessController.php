<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Models\User;

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
        $this->data->success = true;
        $this->data->businesses = Business::all();

        return $this->json();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data->success = false;
        $this->data->error = "Not allowed";

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

        if ($validation->fails())
        {
          $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
          // store new biz
            $business = new Business($business_data);
            $business->users_id = $user->id;
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
