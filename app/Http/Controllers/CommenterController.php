<?php namespace App\Http\Controllers;

use App\Http\Requests\CommenterCreateRequest;
use App\Models\BusinessCommenter;
use Illuminate\Http\Request;
use App\Models\Commenter;
use App\Models\Business;
use App\Models\User;

class CommenterController extends Controller {
    public function index(Business $business)
    {
        return \View::make('dashboard.crud.business.commenter.index', compact('business'));
    }

    public function show(Business $business, Commenter $commenter)
    {

    }

    public function create(Business $business)
    {
        $commenter = Commenter::stub();

        return \View::make('dashboard.crud.business.commenter.create', compact('business', 'commenter'));
    }

    public function store(CommenterCreateRequest $request, Business $business)
    {
        $commenter = Commenter::make($request->all());

        if (!BusinessCommenter::whereBusinessId($business->id)->whereCommenterId($commenter->id)->count()) {
            $commenter->businesses()->attach($business->id, ['adder_id' => \Auth::id()]);
        }

        return \Redirect::route('business.commenters', $business)->with('message', 'Customer successfully saved');
    }

    public function destroy(Business $business, Commenter $commenter)
    {
        $message = 'Customer couldn\'t be deleted.';
        $success = true;
        $redirect = \URL::route('business.commenters', $business);

        if (null !== ($business_commenter = $commenter->businessCommenter($business->id))) {
            $success = $business_commenter->delete();
            $message = 'Customer deleted.';
        }

        if (\Request::ajax()) {
            \Session::flash('message', 'asd');
            return \Response::json([
                'success' => $success,
                'message' => $message,
                'redirect' => $redirect
            ]);
        } else {
            return \Redirect::to($redirect)->with('message', $message);
        }
    }

    public function check(Business $business)
    {
        $commenter_ids = $business->commenters->ids();

        $users_page = User::paginate()->items();

        $users = [];
        foreach ($users_page->items() as $user) {
            $user->is_commenter = isset($commenter_ids[$user->id]);

            $users[$user->id] = $user;
        }

        return \View::make('dashboard.crud.business.commenter.check', compact('business', 'users_page', 'users'));
    }

    public function assign(Request $request, Business $business)
    {
        $commenter_ids = $request->commenter_ids;

        $commenters = Commenter::whereIn($request->commenter_ids)->get();

        return \Redirect::back()->with('Customers for this business updated correctly');
    }
}
