<?php namespace App\Services;

use Illuminate\Http\Request;

class PaginateService {

    private $paginate;
    private $perpage = 10;

    public function __construct($query)
    {
            $this->query($query);
    }

    public function query($query)
    {
        $perpage = Request::capture()->input('perpage') ? intval(Request::capture()->input('perpage')) : $this->perpage;

        $this->paginate = $query->paginate($perpage)->toArray();
    }

    public function data()
    {
        return $this->paginate["data"];
    }

    public function paging()
    {
        $return = new \stdClass();
        $return->page      = $this->paginate["current_page"];
        $return->total     = $this->paginate["total"];
        $return->pages     = ceil($this->paginate["total"] / $this->paginate["per_page"]);
        $return->last      = $this->paginate["last_page"];
        $return->perpage   = $this->paginate["per_page"];
        $return->from      = $this->paginate["from"];
        $return->to        = $this->paginate["to"];
        return $return;
    }
}
