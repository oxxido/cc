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

        $data['own']            = $own;
        $data['own']['admin']   = $own_admin;
        $data['own']['other']   = $own_no_admin;
        $data['admin']          = $admin;
        $data['admin']['own']   = $own_admin;
        $data['admin']['other'] = $no_own_admin;

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
        $comments    = 0;
        $sum_ratings = 0;

        foreach ($businesses as $business) {
            $comments += $business->comments;
            $sum_ratings += $business->sum_ratings;
        }
        $avg_ratings = $comments ? $sum_ratings / ($comments * 2) : 0;

        return [
            'count'       => $businesses->count(),
            'comments'    => $comments,
            'sum_ratings' => $sum_ratings,
            'avg_ratings' => $avg_ratings,
        ];
    }
}
