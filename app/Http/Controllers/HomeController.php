<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

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
            $this->email()->contact($data);
        }
        else
        {
            $this->email()->invite($data);
        }
    }

    return view('home.send');
  }
}
