<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Validator;

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

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => ['getLogout', 'resendEmail', 'activateAccount']]);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{

		$validator = $this->registrar->validator($request->all());
	
		if ($validator->fails())
		{
			$this->throwValidationException(
					$request, $validator
			);
		}

		$activation_code = str_random(60) . $request->input('email');
		$user = new User;
		$user->first_name = $request->input('first_name');
		$user->last_name = $request->input('last_name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->activation_code = $activation_code;
		
		if ($user->save()) {

			$this->sendEmail($user);

			return view('auth.activateAccount')
				->with('email', $request->input('email'));
		
		} else {
			
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
		} else {
			$user->resent = $user->resent + 1;
			$user->save();
			$this->sendEmail($user);
			return view('auth.activateAccount')
				->with('email', $user->email);
		}
	}
	
	public function activateAccount($code, User $user)
	{

		if($user->accountIsActive($code)) {
			\Session::flash('message', \Lang::get('auth.successActivated') );
			return redirect('/dashboard');
		}
	
		\Session::flash('message', \Lang::get('auth.unsuccessful') );
		return redirect('home');
	
	}
	


}
