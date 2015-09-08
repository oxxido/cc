<?php namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Commenter;
use App\Models\Business;
use App\Models\Comment;
use App\Models\User;
use Auth;
use DB;

class ReportController extends Controller
{
    /**
     * Get simple statistics for reports home page
     */
    public function index()
    {
        $data = [];

        $own          = $this->businessesStatistics($this->businessDetails(Auth::id(), true));
        $own_admin    = $this->businessesStatistics($this->businessDetails(Auth::id(), true, true));
        $own_no_admin = $this->businessesStatistics($this->businessDetails(Auth::id(), true, false));
        $no_own_admin = $this->businessesStatistics($this->businessDetails(Auth::id(), false, true));
        $admin        = $this->businessesStatistics($this->businessDetails(Auth::id(), null, true));

        $data['own']            = $own;
        $data['own']['admin']   = $own_admin;
        $data['own']['other']   = $own_no_admin;
        $data['admin']          = $admin;
        $data['admin']['own']   = $own_admin;
        $data['admin']['other'] = $no_own_admin;

        dd($data);
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
    protected function businessDetails($id, $owner = null, $admin = null)
    {
        $query = Business::select(DB::raw('businesses.id, count(c.id) AS comments, sum(c.rating) AS sum_ratings, avg(c.rating) AS avg_ratings'))->join('business_commenter AS bc',
            'businesses.id', '=', 'bc.business_id')->join('comments AS c', 'bc.id', '=',
            'c.business_commenter_id')->where(function ($query) use ($id, $owner, $admin) {
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
    protected function businessesStatistics(Collection $businesses)
    {
        $comments    = 0;
        $sum_ratings = 0;

        foreach ($businesses as $business) {
            $comments += $business->comments;
            $sum_ratings += $business->sum_ratings;
        }
        $avg_ratings = $comments ? $sum_ratings / $comments : 0;

        return [
            'count'       => $businesses->count(),
            'comments'    => $comments,
            'sum_ratings' => $sum_ratings,
            'avg_ratings' => $avg_ratings,
        ];
    }
}
