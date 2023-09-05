<?php

namespace App\Providers;

use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider.
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot(
        BrandInterface $brandInterface,
        CategoryInterface $categoryInterface
    ) {
        View::composer(
            'admin.*',
            function ($view) {
                $view->with('admin_composer', Auth::guard('admin')->user());
            }
        );

        View::composer(
            'admin.product.*',
            function ($view) use ($brandInterface, $categoryInterface) {
                $view->with(
                    [
                        'brands'     => $brandInterface->all(),
                        'categories' => $categoryInterface->all(),
                    ]
                );
            }
        );
    }
}
