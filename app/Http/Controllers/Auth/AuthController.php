<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Template;
use Validator;
use Auth;
use Session;
use Lang;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Services\UserService;
use App\Services\AdminService;
use Event;
use App\Events\UserEmailEvent;

class AuthController extends Controller {

    protected $redirectPath = '/dashboard';

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

    use AuthenticatesAndRegistersUsers {
      AuthenticatesAndRegistersUsers::getLogout as traitGetLogout;
    }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','getInactive','getResend','getActivate']]);
        $this->middleware('inactive', ['only' => ['getInactive','getResend','getActivate']]);
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
        	Auth::login($user);
            $owner = UserService::createOwner($user);
            AdminService::create(['admin_id' => $user->id, "owner_id" => $owner->id]);

            return view('auth.activateAccount')
                ->with('email', $request->input('email'));
        }
        else
        {
            Session::flash('message', Lang::get('notCreated') );
            return redirect()->back()->withInput();
        }
    }

    public function getResend()
    {
        $user = Auth::user();
        if( $user->resent >= 3 )
        {
            return view('auth.tooManyEmails')
                ->with('email', $user->email)
                ->with('date', $user->updated_at->format('Y-m-d '));;
        }
        else
        {
            $user->resent = $user->resent + 1;
            $user->save();

            Event::fire(new UserEmailEvent($user, "user", ["resend" => true]));
            Session::flash('message', 'Activation email sent');
            return redirect('auth/inactive');
        }
    }

    public function getActivate($code = false)
    {
        if($user = User::where('activation_code', '=', $code)->first())
        {
            $user->active = 1;
            $user->activation_code = '';
            $user->save();

            Auth::login($user);
            Session::flash('message', Lang::get('auth.successActivated') );

            if($user->isOwner())
            {
                return redirect('/dashowner');
            }
            elseif($user->isAdmin())
            {
                return redirect('/dashadmin');
            }
        }

        Session::flash('message', Lang::get('auth.unsuccessful') );
        return redirect('home');
    }

    public function getInactive()
    {
        $user = Auth::user();
        return view('auth.guestActivate')
            ->with('email', $user->email)
            ->with('date', Auth::user()->updated_at->format('Y-m-d'));
    }

    public function getLogout()
    {
        Session::forget('business_id');
        return $this->traitGetLogout();
    }
}
