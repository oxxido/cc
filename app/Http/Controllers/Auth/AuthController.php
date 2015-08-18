<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;

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

		$validator = $this->validator($request->all());
	
		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		if ($user = $this->create($request->all()))
		{
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'activation_code' => str_random(60)
		]);
    }

}
