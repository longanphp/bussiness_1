<?php

namespace App\Modules\Client\ProductClient\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductClientController extends Controller
{
    protected BrandInterface $brandInterface;
    protected ProductInterface $productInterface;
    protected CategoryInterface $categoryInterface;

    public function __construct(
        BrandInterface $brandInterface,
        ProductInterface $productInterface,
        CategoryInterface $categoryInterface
    )
    {
        $this->brandInterface = $brandInterface;
        $this->productInterface = $productInterface;
        $this->categoryInterface = $categoryInterface;
    }

    /**
     * @param $slug
     *
     * @return Application|Factory|View
     */
    public function getBySlug($slug): View|Factory|Application
    {
        $product = $this->productInterface->getBySlug($slug);

        return view('client.product.detail', compact('product'));
    }
}
