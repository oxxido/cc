<?php namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Services\FeedbackService;
use App\Models\Product;

class WidgetController extends Controller
{

    public function getFeedback($id)
    {
        $product = Product::find($id);
        $this->data->product = $product;

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
            'last_name'  => $request->input('last_name')
        ]);

        $business_commenter = FeedbackService::getBusinessCommenter([
            'commenter_id' => $commenter->id,
            'business_id'  => $product->business->id
        ]);

        $comment = FeedbackService::createComment([
            'product_id'            => $product->id,
            'business_commenter_id' => $business_commenter->id,
            'comment'               => $request->input('comment'),
            'rating'                => $request->input('rating')
        ]);

        $this->data->product = $product;
        if($request->input('rating') >= 8)
        {
            return $this->view("widget.feedbackPositive");
        }
        else
        {
            return $this->view("widget.feedbackNegative");
        }
    }

    public function getReviews($id)
    {
        $product = Product::find($id);
        $this->data->product = $product;

        return $this->view("widget.reviews");
    }
}
