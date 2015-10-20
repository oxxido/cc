<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Commenter;

class HomeController extends Controller
{
    /**
     * show the invite request to the user
     *
     * @return Response
     */
    public function send(Request $request)
    {
        $data = [
            'name'    => $request->input('name'),
            'company' => $request->input('company'),
            'email'   => $request->input('email'),
            'website' => $request->input('website')
        ];

        // Instantiate validator using received post parameters and setted rules
        $validation = \Validator::make(\Request::all(), [
            'name'    => 'required',
            'company' => 'required',
            'email'   => "required|email",
            'website' => 'required|url'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->getMessageBag()->toArray());
        } else {
            if ($request->input('source') == "contact") {
                $data['msg'] = $request->input('msg');
                $this->email()->contact($data);
            } else {
                $this->email()->invite($data);
            }
        }

        return view('home.send');
    }

    public function getUnsuscribe(Commenter $commenter, Request $request)
    {
        $request->session()->flash('commenter_id', $commenter->id);
        return redirect('suscription');
    }

    public function getSuscription(Request $request)
    {
        $commenter = Commenter::findOrFail(session('commenter_id'));
        $this->data->commenter = $commenter;
        $this->data->business_commenter = $commenter->businessCommenters;
        $this->data->mail_suscribe = $commenter->mailSuscribe;
        return $this->view("home.suscription");
    }

    public function postSuscription(Request $request)
    {
        $commenter = Commenter::findOrFail($request->input('commenter_id'));
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

        $request->session()->flash('commenter_id', $commenter->id);
        return redirect('suscription');
    }
}
