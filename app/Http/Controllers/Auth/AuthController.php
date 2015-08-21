<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Template;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Services\UserService;

class AuthController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','activateAccount']]);
    }

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{

		$validator = UserService::validator($request->all());
	
		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		if ($user = UserService::create($request->all()))
		{
			UserService::makeOwner($user);
			$this->sendEmail($user);
			return view('auth.activateAccount')
				->with('email', $request->input('email'));
		}
		else
		{
			\Session::flash('message', \Lang::get('notCreated') );
			return redirect()->back()->withInput();
		}
	}
	
	public function sendEmail(User $user)
	{

		$data = array(
				'name' => $user->name,
				'code' => $user->activation_code,
		);

        if(strpos(url(), "localhost") === false)
        {
            /*
            //get template from db
            $template = Template::first();
            $msg = \DbView::make($template)->with($data)->render();
            \Mail::raw($msg, function($message) use ($user) {
                $message->from("gerardo@rosciano.com.ar");
                $message->subject( \Lang::get('auth.activateEmailSubject') );
                $message->to($user->email);
            });*/

			\Mail::queue('emails.activateAccount', $data, function($message) use ($user) {
				$message->from("gerardo@rosciano.com.ar");
				$message->subject( \Lang::get('auth.activateEmailSubject') );
				$message->to($user->email);
			});
            
		}
	}
	
	public function resendEmail()
	{
		$user = \Auth::user();
		if( $user->resent >= 3 )
		{
			return view('auth.tooManyEmails')
				->with('email', $user->email);
		}
		else
		{
			$user->resent = $user->resent + 1;
			$user->save();

			$this->sendEmail($user);
			return view('auth.activateAccount')
				->with('email', $user->email);
		}
	}
	
	public function activateAccount($code, User $user)
	{

		if($user->accountIsActive($code))
		{
			\Auth::login($user);
			\Session::flash('message', \Lang::get('auth.successActivated') );
			return redirect('/dashboard');
		}
	
		\Session::flash('message', \Lang::get('auth.unsuccessful') );
		return redirect('home');
	
	}

}
