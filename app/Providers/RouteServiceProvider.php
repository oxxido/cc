<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\OrganizationType;
use Illuminate\Routing\Router;
use App\Models\SocialNetwork;
use App\Models\BusinessType;
use App\Models\Business;
use App\Models\Country;
use App\Models\Product;
use App\Models\State;
use App\Models\City;
use App\Models\User;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
        //
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });

        $this->modelBindings($router);
    }

    protected function modelBindings(Router $router)
    {
        $uuid_pattern = '[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}';

        $router->pattern('user', $uuid_pattern);
        $router->bind('user', function ($uuid) {
            return User::whereUuid($uuid)->firstOrFail();
        });

        $router->pattern('biz', $uuid_pattern);
        $router->bind('biz', function ($uuid) {
            return Business::whereUuid($uuid)->firstOrFail();
        });

        $router->pattern('product', $uuid_pattern);
        $router->bind('product', function ($uuid) {
            return Product::whereUuid($uuid)->firstOrFail();
        });
    }
}
