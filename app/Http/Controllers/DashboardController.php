<?php namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Models\Admin;

class DashboardController extends Controller {


    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->user = Auth::user();
        $this->data->user = $this->user;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getIndex()
    {
        if($this->user->isOwner())
        {
            return redirect('/dashowner');
        }
        elseif($this->user->isAdmin())
        {
            return redirect('/dashbiz');
        }
    }

    /**
     * 
     *
     * @return Response
     */
    public function getAccount()
    {
        return $this->view('dashboard/account');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getWidgets()
    {
        return $this->view('dashboard/widgets');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getReports()
    {
        return $this->view('dashboard/reports');
    }

    /**
     * 
     *
     * @return Response
     */
    public function getHelp()
    {
        return $this->view('dashboard/help');
    }

}
