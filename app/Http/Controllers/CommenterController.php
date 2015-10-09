<?php namespace App\Http\Controllers;
use DB;
use App\Http\Requests\CommenterCreateRequest;
use App\Models\BusinessCommenter;
use App\Services\EmailService;
use Illuminate\Http\Request;
use App\Models\Commenter;
use App\Models\Business;
use App\Models\User;
use App\Models\MailSuscribe;

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

        if (null === ($business_commenter = BusinessCommenter::whereBusinessId($business->id)->whereCommenterId($commenter->id)->first())) {
            $business_commenter = BusinessCommenter::create([
                'business_id' => $business->id,
                'commenter_id' => $commenter->id,
                'adder_id' => \Auth::id()
            ]);

            for ($i = 1; $i <= MailSuscribe::MAIL_TYPE_QT ; $i++) { 
                $mail_suscribe = MailSuscribe::create([
                    'business_id' => $business->id,
                    'commenter_id' => $commenter->id,
                    'mail_type' => $i
                ]);
            }
        }

        //if ($commenter->mail_suscribe && $business_commenter->mail_suscribe) {
            if ($request->get('send_feedback_request')) {
                EmailService::instance()->requestFeedback($business_commenter);
            }
        //}

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
            \Session::flash('message', $message);
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

    public function getSuscription($hash, Request $request)
    {
        $commenter = $this->findCommenter($hash);
        $this->setBasicData($commenter, $request);
        return $this->view("commenter.suscription");
    }

    private function findCommenter($hash)
    {
        $user = User::where('uuid','=',$hash)->first();
        return $user->commenter;
    }

    private function setBasicData($commenter, $request)
    {
        $this->data->user = \Auth::user();
        $this->data->commenter = $commenter;
        $this->data->business_commenter = $commenter->businessCommenters;
        $this->data->mail_suscribe = $commenter->mailSuscribe;
        $this->data->success = true;
    } 

    public function postSuscription(Request $request)
    {
        $commenter = Commenter::find($request->input('commenter_id'));
        $commenter->mail_unsuscribe = is_null($request->input('unsuscribe_all')) ? false : true;

        if ($request->input('businesses')) {
            $business_commenter = $commenter->businessCommenters()->where('business_id','=',$request->input('businesses'))->first();
            $business_commenter->mail_unsuscribe = is_null($request->input('unsuscribe_biz')) ? false : true;
            $mail_suscribe = $commenter->mailSuscribe()->where('business_id','=',$request->input('businesses'))->get();
            
            foreach ($mail_suscribe as $mail) {
                $mail->unsuscribe = is_null($request->input('mail'.$mail->mail_type)) ? false : true;
                $mail->save();
            }

            $business_commenter->save();
        }
        $commenter->save();

        $this->data->saved = true;
        $this->data->commenter = $commenter;
        $this->data->business_commenter = $commenter->businessCommenters;
        $this->data->mail_suscribe = $commenter->mailSuscribe;
        $this->data->user = \Auth::user();
        $this->data->success = true;

        return $this->view("commenter.suscription");
    }
}
