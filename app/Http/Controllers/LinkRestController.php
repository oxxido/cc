<?php namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Link;
use App\Models\Admin;
use App\Models\Business;
use App\Models\Country;
use App\Models\SocialNetwork;

use App\Services\PaginateService;
use App\Services\UserService;
use App\Services\AdminService;
use App\Services\BusinessService;
use App\Services\LinkService;
use Webpatser\Uuid\Uuid;

class LinkRestController extends Controller {

    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Business $business)
    {
        $query = Link::where("business_id", "=", $business->id);

        $paginate = new PaginateService($query);

        $this->data->success = true;
        $this->data->links = $paginate->data();
        $this->data->paging = $paginate->paging();

        return $this->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Business $business, Request $request)
    {
        $success = false;

        $validation = LinkService::validator($request->all());
        if ($validation->fails())
        {
            $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
            $link = Link::create([
                'business_id' => $business->id,
                'social_network_id' => $request->input('social_network_id'),
                'uuid' => Uuid::generate(),
                'url'    => $request->input('url'),
                'order'  => 1,
                'active' => 1
            ]);

            $this->data->link = $link;
            $success = true;
        }

        $this->data->success = $success;
        return $this->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Business $business, Link $link)
    {
        $this->data->success = true;
        $this->data->link = $link;
        return $this->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Business $business, Link $link, Request $request)
    {
        $success = false;

        $validation = LinkService::validator($request->all());

        if ($validation->fails())
        {
            $this->data->errors = $validation->getMessageBag()->toArray();
        }
        else
        {
            $link->social_network_id = $request->input('social_network_id');
            $link->url = $request->input('url');
            $success = $link->save();
            $this->data->link = $link;
        }

        $this->data->success = $success;

        return $this->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Business $business, Link $link)
    {
        $this->data->name = $link->profile;
        $this->data->success = $link->delete();
        return $this->json();
    }

}
