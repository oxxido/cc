<?php namespace App\Http\Controllers;

use App\Http\Requests\CommenterCreateRequest;
use App\Models\BusinessCommenter;
use App\Services\EmailService;
use App\Services\CommenterService;
use Illuminate\Http\Request;
use App\Models\Commenter;
use App\Models\Business;
use App\Models\User;
use App\Models\MailSuscribe;

class CommenterRestController extends Controller {

    public function index(Business $business)
    {
        return \View::make('dashboard.crud.business.commenter.index', compact('business'));
    }

    public function import(Business $business, Request $request)
    {
        $upload    = $request->file('csv');
        $validator = \Validator::make(['csv' => $upload], [
            'csv' => 'required|max:3072'
        ], [
            'csv.required' => trans('logs.validation.required'),
            'csv.max'      => trans('logs.validation.max_size')
        ]);

        $mines = [
            'csv',
            'txt',
            'xls',
            'application/vnd.ms-excel',
            'application/msexcel',
            'application/x-msexcel',
            'application/x-ms-excel',
            'application/x-excel',
            'application/x-dos_ms_excel',
            'application/xls',
            'application/x-xls',
            'application/excel',
            'application/download',
            'application/vnd.ms-office',
            'application/msword',
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/vnd.msexcel',
            'text/plain',
        ];

        if ($validator->fails()) {
            $this->data->errors = $validator->getMessageBag()->toArray();
        } elseif (!$upload->isValid()) {
            $this->data->errors = trans('logs.validation.invalid');
        } elseif (!in_array($upload->getClientMimeType(), $mines)) {
            $this->data->errors = trans('logs.validation.mime_type', ['mimetype' => $upload->getClientMimeType()]);
        } else {
            $tmp  = \Webpatser\Uuid\Uuid::generate() . '.' . $upload->getClientOriginalExtension();
            $path = storage_path("app/");
            $upload->move($path, $tmp);
            $tmp_path = $path . $tmp;

            $csv   = \Excel::load($tmp_path);
            $lines = $csv->get();

            $heading = "first_name,last_name,email,phone,note";
            if(!$csv->first() || array_keys($csv->first()->toArray()) !== explode(",", $heading))
            {
                $this->data->errors = trans('logs.validation.format');
            } else {
                notification_csv(trans('logs.parse.initializing'), "info", false, true);

                $results = [];

                foreach ($lines as $i => $line) {
                    $index = $i + 1;
                    set_time_limit(30);
                    notification_csv(trans('logs.parse.line', ['line' => $index]), "warning", $index);
                    $result         = new \stdClass;
                    $result->line   = $line;
                    $result->errors = [];

                    $validator = \Validator::make($line->toArray(), [
                        'first_name'    => 'required',
                        'last_name'    => 'required',
                        'email'    => 'required|email',
                        'phone'    => 'required',
                    ]);

                    if ($errors = $validator->getMessageBag()->toArray()) {
                        $errors         = array_merge([trans('logs.parse.line_error')], $errors);
                        $result->errors = $errors;
                        notification_csv($errors, "danger");
                        notification_csv(trans('logs.parse.line_not_saved', ['line' => $index]), "danger");
                    } else {
                        $commenter = CommenterService::getCommenter([
                            'email'      => $line->email,
                            'first_name' => $line->first_name,
                            'last_name'  => $line->last_name,
                            'phone'      => $line->phone,
                            'note'       => $line->note
                        ]);

                        $business_commenter = CommenterService::getBusinessCommenter([
                            'commenter_id' => $commenter->id,
                            'business_id'  => $business->id,
                            'adder_id' => \Auth::id()
                        ]);

                        for ($i = 1; $i <= MailSuscribe::MAIL_TYPE_QT ; $i++) {
                            $mail_suscribe = MailSuscribe::create([
                                'business_id' => $business->id,
                                'commenter_id' => $commenter->id,
                                'mail_type' => $i
                            ]);
                        }

                        //EmailService::instance()->requestFeedback($business_commenter);
                        notification_csv(trans('logs.parse.line_saved', ['line' => $index]), "success");

                        $result->commenter = $commenter;
                        $result->errors = $errors;
                    }
                    $results[] = $result;
                }
                $this->data->results = $results;
            }

            \Storage::delete($tmp);
        }

        return $this->json();
    }

    public function sendrequest(Business $business, Commenter $commenter)
    {
        $this->data->success = true;
        $this->data->message = "Request Feedback successfully sent";
        EmailService::instance()->requestFeedback($commenter->businessCommenter($business->id));
        return $this->json();
    }

    public function create(Business $business)
    {
        $commenter = Commenter::stub();

        return \View::make('dashboard.crud.business.commenter.create', compact('business', 'commenter'));
    }

    public function store(CommenterCreateRequest $request, Business $business)
    {

        $commenter = CommenterService::getCommenter([
            'email'      => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'phone'      => $request->input('phone'),
            'note'       => $request->input('note')
        ]);

        $business_commenter = CommenterService::getBusinessCommenter([
            'commenter_id' => $commenter->id,
            'business_id'  => $business->id,
            'adder_id' => \Auth::id()
        ]);

        for ($i = 1; $i <= MailSuscribe::MAIL_TYPE_QT ; $i++) {
            $mail_suscribe = MailSuscribe::create([
                'business_id' => $business->id,
                'commenter_id' => $commenter->id,
                'mail_type' => $i
            ]);
        }

        if ($request->get('send_feedback_request')) {
            EmailService::instance()->requestFeedback($business_commenter);
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
}
