<?php namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Services\FeedbackService;
use App\Services\PaginateService;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Link;

class WidgetController extends Controller
{

    public function getFeedback($hash)
    {
        $product = $this->findProduct($hash);
        $this->data->product = $product;
        $this->data->business = $product->business;
        $this->data->config = $product->business->config;
        $this->data->user = \Auth::user();

        return $this->view("widget.feedback");
    }

    public function postFeedback(Request $request)
    {
        $validator = FeedbackService::validator($request->all());
        $product = Product::find($request->input('product_id'));

        if ($validator->fails())
        {
            return redirect('widget/feedback/' . $product->id)
                ->withErrors($validator)
                ->withInput();
        }
        $commenter = FeedbackService::getCommenter([
            'email'      => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'phone'      => $request->input('phone')
        ]);

        $business_commenter = FeedbackService::getBusinessCommenter([
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
        $this->data->product = $product;
        $this->data->business = $product->business;
        $this->data->config = $product->business->config;
        
        $this->data->user = \Auth::user();

        if($rating >= $product->business->config->feedback->positiveThreshold)
        {
            $this->data->config->feedback->positiveFeedbackPage = FeedbackService::tagsreplace($this->data->config->feedback->positiveFeedbackPage, $product->business);
            $this->data->links = $product->business->links;
            return $this->view("widget.feedbackPositive");
        }
        else
        {
            $this->data->config->feedback->negativeFeedbackPage = FeedbackService::tagsreplace($this->data->config->feedback->negativeFeedbackPage, $product->business);
            return $this->view("widget.feedbackNegative");
        }
    }

    public function getTestimonial($hash)
    {
        $product = $this->findProduct($hash);
        $this->data->product = $product;
        $this->data->business = $product->business;
        $this->data->config = $product->business->config;
        $this->data->user = \Auth::user();
        return $this->view("widget.testimonial");
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

    private function findProduct($hash)
    {
        $id = intval(str_replace("product_id=", "", base64_decode($hash)));
        return Product::find($id);
    }
}
