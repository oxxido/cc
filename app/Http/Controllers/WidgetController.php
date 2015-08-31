<?php namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Services\FeedbackService;
use App\Services\PaginateService;
use App\Models\Product;
use App\Models\Comment;

class WidgetController extends Controller
{

    public function getFeedback($id)
    {
        $product = $this->findProduct($id);
        $this->data->product = $product;

        return $this->view("widget.feedback");
    }

    public function postFeedback(Request $request)
    {
        $validator = FeedbackService::validator($request->all());
        $product = $this->findProduct($request->input('product_id'));

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

    public function getTestimonial($id)
    {
        $product = $this->findProduct($id);
        $this->data->product = $product;
        return $this->view("widget.testimonial");
    }

    public function getReviews(Request $request)
    {
        $id = $request->input('product_id');
        $product = $this->findProduct($id);
        $query = Comment::where("product_id", "=", $product->id);
        $paginate = new PaginateService($query);

        $this->data->success = true;
        $this->data->comments = $paginate->data();
        $this->data->paging = $paginate->paging();

        return $this->json();
    }

    private function findProduct($hash)
    {
        return Product::find($hash);
    }

    private function idEncrypt($id)
    {
        $pass = '1234';
        $method = 'aes128';
        $string = $id;
        return openssl_encrypt($string, $method, $pass);
    }

    private function idDecrypt($hash)
    {
        $pass = '1234';
        $method = 'aes128';
        $string = $hash;
        return openssl_decrypt($string, $method, $pass);
    }

}
