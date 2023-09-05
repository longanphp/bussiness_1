<?php

namespace App\Providers;

use App\Modules\Admin\Account\Interfaces\AccountAdminInterface;
use App\Modules\Admin\Account\Services\AccountAdminService;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Brand\Services\BrandService;
use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use App\Modules\Admin\Category\Services\CategoryService;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use App\Modules\Admin\Product\Services\ProductService;
use App\Modules\Admin\Storehouse\Interfaces\StorehouseInterface;
use App\Modules\Admin\Storehouse\Services\StorehouseService;
use App\Modules\Client\Auth\Interfaces\AuthInterface;
use App\Modules\Client\Auth\Services\AuthService;
use App\Modules\Client\Cart\Interfaces\CartInterface;
use App\Modules\Client\Cart\Services\CartService;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Modules\Media\Services\MediaService;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AccountAdminInterface::class, AccountAdminService::class);
        $this->app->singleton(MediaInterface::class, MediaService::class);
        $this->app->singleton(CategoryInterface::class, CategoryService::class);
        $this->app->singleton(BrandInterface::class, BrandService::class);
        $this->app->singleton(ProductInterface::class, ProductService::class);
        $this->app->singleton(StorehouseInterface::class, StorehouseService::class);
        $this->app->singleton(AuthInterface::class, AuthService::class);
        $this->app->singleton(CartInterface::class, CartService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
