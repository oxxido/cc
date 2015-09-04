<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

  /*
  |--------------------------------------------------------------------------
  | Home Controller
  |--------------------------------------------------------------------------
  |
  | This controller renders your application's "dashboard" for users that
  | are authenticated. Of course, you are free to change or remove the
  | controller as you wish. It is just here to get your app started!
  |
  */

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //$this->middleware('auth');
  }

  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function index()
  {
    return view('home');
  }

  /**
   * show the invite request to the user
   *
   * @return Response
   */
  public function send(Request $request)
  {
    $data = array(
        'name'    => $request->input('name'),
        'company' => $request->input('company'),
        'email'   => $request->input('email'),
        'website' => $request->input('website')
    );

    // Instantiate validator using received post parameters and setted rules
    $validation = \Validator::make(\Request::all(), [
        'name'    => 'required',
        'company' => 'required',
        'email'   => "required|email",
        'website'     => 'required|url'
    ]);

    if ($validation->fails())
    {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors($validation->getMessageBag()->toArray());
    }
    else
    {
        if($request->input('source')=="contact")
        {
            $data['msg'] = $request->input('msg');
            $this->email()->contact(['to' => 'oxxido@gmail.com', 'data' => $data]);
        }
        else
        {
            $this->email()->invite(['to' => 'oxxido@gmail.com', 'data' => $data]);
        }
    }

    return view('send');
  }
}
