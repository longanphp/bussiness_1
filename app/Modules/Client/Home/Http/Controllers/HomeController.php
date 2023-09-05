<?php

namespace App\Modules\Client\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use App\Modules\Admin\Product\Interfaces\ProductInterface;

class HomeController extends Controller
{
    protected $brandInterface;
    protected $productInterface;
    protected $categoryInterface;

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

    public function index()
    {
        $brands = $this->brandInterface->getPublish();
        $categories = $this->categoryInterface->getPublish();
        $productIsFeatured = $this->productInterface->getIsFeatured();

        return view('client.home.index', compact('brands', 'categories', 'productIsFeatured'));
    }
}
