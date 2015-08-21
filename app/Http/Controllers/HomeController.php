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

  public function howitworks()
  {
    return view('howitworks');
  }

  public function pricing()
  {
    return view('pricing');
  }

  public function faqs()
  {
    return view('faqs');
  }


  /**
   * show the invite request to the user
   *
   * @return Response
   */
  public function request()
  {
    return view('requestAnInvite');
  }
  /**
   * show the invite request to the user
   *
   * @return Response
   */
  public function post_request(Request $request)
  {
    /*
      1. Validate that the input is properly formed
      2. Attempt to send email (and store data?)
      3. Respond with view or redirect
    */

    // Fields to get from form
    $user_data = array(
      'name'    => $request->input('name'),
      'company' => $request->input('company'),
      'email'   => $request->input('email'),
      'website'     => $request->input('website')
    );

    // Validation rules to aply to fields
    $rules = array(
      'name'    => 'required',
      'company' => 'required',
      'email'   => "required|email",
      'website'     => 'required|url'
    );

    // Instantiate validator using received post parameters and setted rules
    $validation = \Validator::make(\Request::all(), $rules);

    if ($validation->fails())
    {

      //\Session::flash('messages', $validation->getMessageBag()->toArray() );
      //exit(print_r($validation->getMessageBag()->toArray(),true));
      return redirect()->back()->withInput()->withErrors($validation->getMessageBag()->toArray());
    }
    else
    {
      //send email
      if(strpos(url(), "localhost") === false)
      {
        if($request->input('source')=="contact") {
          $emailTmpl = 'emails.contact';
          $user_data['msg'] = $request->input('msg');
          $emailSubject = 'Contact form';
        } else {
          $emailTmpl = 'emails.requestAnInvite';
          $emailSubject = 'Request an invite';
        }
        \Mail::queue($emailTmpl, $user_data, function($message) {
          $message->from("gerardo@rosciano.com.ar");
          $message->subject( "Email from site" );
          $message->to("oxxido@gmail.com");
        });
      }
    }

    
    return view('requestSent');
  }
}
