<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller {

    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \Debugbar::disable();

        $this->middleware('auth');
        $this->middleware('admin');

        $this->user = Auth::user();;
    }

    /**
     * Show the application dashboard to the owner site.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
        $request->session()->reflash();
        return redirect('dashadmin/business');
        return $this->view('dashboard.admin.index');
    }

    /**
     * Businesses page in dashboard.
     *
     * @return Response
     */
    public function getBusiness()
    {
        $admins = $this->user->admin();
        $businesses = [];
        foreach ($admins as $admin)
        {
            foreach ($admin->businesses as $business)
                $businesses[] = $business;
        }
        $this->data->businesses = $businesses;
        return $this->view('dashboard.admin.business');
    }
}
