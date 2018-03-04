<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 04.03.18
 * Time: 20:40
 */

namespace App\Providers;

use App\Services\ProductService;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;


class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductService::class, function (){
            return new ProductService();
        });
    }
}