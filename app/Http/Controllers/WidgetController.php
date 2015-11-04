<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Services\BusinessService;
use App\Services\CommenterService;
use App\Services\FeedbackService;
use App\Services\PaginateService;
use App\Models\User;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Link;

class WidgetController extends Controller
{
    public function __construct()
    {
        \Debugbar::disable();
    }

    public function getFeedback(Request $request, $context, $product_uuid, $user_uuid = false)
    {
        if($user_uuid)
        {
            $user = User::whereUuid($user_uuid)->firstOrFail();
            if(!$user->active)
            {
                $user->active = 1;
                $user->activation_code = '';
                $user->save();
            }
            Auth::login($user);
            return redirect('widget/feedback/landing/' . $product_uuid);
        }

        $product = Product::whereUuid($product_uuid)->firstOrFail();
        $this->setBasicData($product, $request);
        return $this->view("widget.$context.feedback");
    }

    public function postFeedback(Request $request, $context)
    {
        $validator = FeedbackService::validator($request->all());
        $product = Product::findOrFail($request->input('product_id'));

        if ($validator->fails())
        {
            return redirect('widget/feedback/' . $product->id)
                ->withErrors($validator)
                ->withInput();
        }
        if($user = Auth::user())
        {
            if(!($commenter = $user->commenter))
            {
                $commenter = CommenterService::createCommenter([
                    'id'    => $user->id,
                    'phone' => $request->input('phone'),
                    'note'  => $request->input('note')
                ]);
            }
        }
        else
        {
            $commenter = CommenterService::getCommenter([
                'email'      => $request->input('email'),
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'phone'      => $request->input('phone')
            ]);
        }

        $business_commenter = CommenterService::getBusinessCommenter([
            'commenter_id' => $commenter->id,
            'business_id'  => $product->business->id
        ]);

        $rating = trim($request->input('rating'));

        $comment = FeedbackService::createComment([
            'product_id'            => $product->id,
            'business_commenter_id' => $business_commenter->id,
            'comment'               => $request->input('comment'),
            'rating'                => $rating
        ]);

        $this->data->comment = $comment;
        $this->setBasicData($product, $request);

        if($rating >= $this->data->config->feedback->positive_threshold)
        {
            $this->data->config->feedback->positive_text_header = BusinessService::tagsReplace([
                "text" => $this->data->config->feedback->positive_text,
                "business" => $product->business,
                "comment" => $comment,
                "section" => "header"
            ]);
            $this->data->config->feedback->positive_text_footer = BusinessService::tagsReplace([
                "text" => $this->data->config->feedback->positive_text,
                "business" => $product->business,
                "comment" => $comment,
                "section" => "footer"
            ]);

            $this->data->links = $product->business->links;

            return $this->view("widget.$context.feedbackPositive");
        }
        else
        {
            $this->data->config->feedback->negative_text = BusinessService::tagsReplace([
                "text" => $this->data->config->feedback->negative_text,
                "business" => $product->business,
                "comment" => $comment
            ]);

            return $this->view("widget.$context.feedbackNegative");
        }
    }

    public function postRefeedback(Request $request, $context)
    {
        $comment = Comment::find($request->input('comment_id'));
        $this->setBasicData($comment->product, $request);
        $this->data->noform = true;
        return $this->view("widget.$context.feedbackNegative");
    }

    public function getTestimonial(Request $request, $context, $product_uuid)
    {
        $product = Product::whereUuid($product_uuid)->firstOrFail();
        $this->setBasicData($product, $request);
        return $this->view("widget.$context.testimonial");
    }

    public function getReviews(Request $request)
    {
        $id = $request->input('product_id');
        $product =  Product::find($id);
        $query = Comment::where("product_id", "=", $product->id)->orderBy('created_at', 'desc');
        $paginate = new PaginateService($query);

        $this->data->success = true;
        $this->data->comments = $paginate->data();
        $this->data->paging = $paginate->paging();

        return $this->json();
    }

    public function getTest($product_uuid)
    {
        $product = Product::whereUuid($product_uuid)->firstOrFail();
        $this->data->product_uuid = $product_uuid;
        return $this->view("widget.test");
    }

    private function setBasicData($product, $request)
    {
        $this->data->product = $product;
        $this->data->business = $product->business;
        $this->data->config = BusinessService::defaultConfig("all", $product->business, $request);
        $this->data->user = \Auth::user();
        if($user = \Auth::User())
        {
            $this->data->commenter = $user->commenter($product);
        }
    }

    public function getScript(Request $request)
    {
        $product_uuid = $request->input('uuid');
        $type = $request->input('type');

        $product = Product::whereUuid($product_uuid)->firstOrFail();

        $contents = \View::make('widget.script')->with(['product_uuid'=>$product_uuid, 'type'=>$type]);
        $response = \Response::make($contents);
        $response->header('Content-Type', 'application/javascript');
        return $response;
    }
}
