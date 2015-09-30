<?php namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Business;
use DB;

class ReportService
{
    public static function basicReport($id)
    {
        $data = [];

        $own          = self::businessesStatistics(self::businessesDetails($id, true));
        $own_admin    = self::businessesStatistics(self::businessesDetails($id, true, true));
        $own_no_admin = self::businessesStatistics(self::businessesDetails($id, true, false));
        $no_own_admin = self::businessesStatistics(self::businessesDetails($id, false, true));
        $admin        = self::businessesStatistics(self::businessesDetails($id, null, true));
        $biz          = self::businessesOwnAdmin($id);

        $negative_comments = 0;
        $positive_comments = 0;
        $request = 0;
        $request_open = 0;
        $request_not_open = 0;
        $request_open_rate = 0;
        $unrequested_comment = 0;
        foreach ($biz as $business) {
            $comments_detail      = self::businessesComments($business->id);
            $request             += self::feedbackRequests($business->id);
            $request_open        += self::feedbackRequestsOpen($business->id);
            $request_not_open    += self::feedbackRequestsNotOpen($business->id);
            $unrequested_comment += self::feedbackWithoutRequest($business->id);

            foreach ($comments_detail as $comment) {
                if ($comment->rating < 7) {
                    $negative_comments++;
                } else {
                    if ($comment->rating > 8) {
                        $positive_comments++;
                    } 
                }
            }
        }
        $request_open_rate = $request == 0 ? 0 : ($request_open / $request) * 100;

        $data['own']                 = $own;
        $data['own']['admin']        = $own_admin;
        $data['own']['other']        = $own_no_admin;
        $data['admin']               = $admin;
        $data['admin']['own']        = $own_admin;
        $data['admin']['other']      = $no_own_admin;
        $data['negative_comments']   = $negative_comments;
        $data['positive_comments']   = $positive_comments;
        $data['request']             = $request;
        $data['request_open_rate']   = $request_open_rate;
        $data['request_not_open']    = $request_not_open;
        $data['request_open']        = $request_open;
        $data['unrequested_comment'] = $unrequested_comment;

        return $data;
    }

    public static function basicPerformanceReport($id)
    {
        return self::businessDetails($id);
    }

    protected static function queryBusinessesDetails()
    {
        return Business::select(DB::raw('*, count(c.id) AS comments, sum(c.rating) AS sum_ratings, avg(c.rating) / 2 AS avg_ratings'))->join('business_commenter AS bc',
            'businesses.id', '=', 'bc.business_id')->join('comments AS c', 'bc.id', '=', 'c.business_commenter_id');
    }

    protected static function businessDetails($id)
    {
        return self::queryBusinessesDetails()->where('businesses.id', '=', $id)->first();
    }

    /**
     * Get businesses on which the id is optionally owner and / or admin, or neither
     *
     * @param      $id
     * @param null $owner
     * @param null $admin
     *
     * @return mixed
     */
    protected static function businessesDetails($id, $owner = null, $admin = null)
    {
        $query = self::queryBusinessesDetails()->where(function ($query) use ($id, $owner, $admin) {
            if (null !== $owner) {
                $query->where('businesses.owner_id', $owner ? '=' : '!=', $id);
            }
        })->groupBy('businesses.id');

        if (null !== $admin) {
            $query->join('admins AS a', function ($join) use ($id, $admin) {
                $join->on('businesses.admin_id', '=', 'a.id');
                $join->on('a.admin_id', $admin ? '=' : '!=', DB::raw($id));
            });
        }

        return $query->get();
    }

    /**
     * Get simple statistics from given businesses
     *
     * @param Collection $businesses
     *
     * @return array
     */
    protected static function businessesStatistics(Collection $businesses)
    {
        $comments          = 0;
        $sum_ratings       = 0;

        foreach ($businesses as $business) {
            $comments += $business->comments;
            $sum_ratings += $business->sum_ratings;
        }
        $avg_ratings = $comments ? $sum_ratings / ($comments * 2) : 0;

        return [
            'count'             => $businesses->count(),
            'comments'          => $comments,
            'sum_ratings'       => $sum_ratings,
            'avg_ratings'       => $avg_ratings,
        ];
            //$negative_comments = $business->rating < 7 ? $negative_comments++ : $negative_comments;
            //$negative_comments += $business->rating;

    }

    /**
     * Get all comments of a business
     *
     * @param $id
     *
     * @return mixed
     */
    protected static function businessesComments($id)
    {
        return DB::table('businesses')
                    ->join('business_commenter AS bc', 'businesses.id', '=', 'bc.business_id')
                    ->join('comments AS c', 'bc.id', '=', 'c.business_commenter_id')
                    ->select('c.*')
                    ->where('businesses.id', '=', $id)
                    ->get();
    }

    /**
     * Get all the businesses that own or admin
     *
     * @param $id
     *
     * @return mixed
     */
    protected static function businessesOwnAdmin($id)
    {
        return DB::table('businesses')
                    ->where('businesses.owner_id', '=', DB::raw($id))
                    ->orWhere('businesses.admin_id', '=', DB::raw($id))
                    ->get();
    }

    /**
     * Get the feedback request count of a business
     *
     * @param $id
     *
     * @return mixed
     */
    protected static function feedbackRequests($id)
    {
        return DB::table('business_commenter')
                    ->where('business_id', '=', $id)
                    ->whereNotNull('adder_id')
                    ->count();
                    //->get();
    }

    /**
     * Get the feedback request open count of a business
     *
     * @param $id
     *
     * @return mixed
     */
    protected static function feedbackRequestsOpen($id)
    {
        return DB::table('business_commenter AS bc')
                    ->join('comments AS c', 'bc.id', '=', 'c.business_commenter_id')
                    ->where('bc.business_id', '=', $id)
                    ->whereNotNull('bc.adder_id')
                    ->count();
    }

    /**
     * Get the feedback count request that not be open of a business
     *
     * @param $id
     *
     * @return mixed
     */
    protected static function feedbackRequestsNotOpen($id)
    {
        return DB::table('business_commenter')
                    ->where('business_id', '=', $id)
                    ->whereNotIn('id', function($query) {
                        $query->select(DB::raw('business_commenter_id'))
                        ->from('comments');
                    })
                    ->count();
    }

    /**
     * Get the feedback comment without request count of a business
     *
     * @param $id
     *
     * @return mixed
     */
    protected static function feedbackWithoutRequest($id)
    {
        return DB::table('business_commenter AS bc')
                    ->join('comments AS c', 'bc.id', '=', 'c.business_commenter_id')
                    ->where('bc.business_id', '=', $id)
                    ->whereNull('bc.adder_id')
                    ->count();
    }

    /**
     * Get the rating comments per month of a business
     *
     * @param $id
     *
     * @return mixed
     */
    protected static function ratingCommentPerMonth($id)
    {
        /*
        $ratings = array($positive, $negative);
        return $ratings;
        */

        /*SP to do this

        select month(c.created_at) as month, count(*) as qcomments from comments c
        inner join business_commenter bc on bc.id = c.business_commenter_id
        where bc.business_id = 4 and year(c.created_at) = year(curdate())
        group by month(c.created_at);
        */
    }
    
}
