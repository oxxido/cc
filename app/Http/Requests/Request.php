<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

abstract class Request extends FormRequest
{
    protected $route;

    public function __construct(Route $route)
    {
        parent::__construct();
        $this->route = $route;
    }
}
