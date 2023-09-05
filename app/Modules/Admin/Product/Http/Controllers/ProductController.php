<?php

namespace App\Modules\Admin\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Product\Http\Requests\ProductRequest;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected ProductInterface $productInterface;

    /**
     * ProductController constructor.
     *
     * @param ProductInterface  $productInterface
     */
    public function __construct(
        ProductInterface $productInterface,
    ) {
        $this->productInterface = $productInterface;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|JsonResponse
     */
    public function index(Request $request): Application|Factory|View|JsonResponse
    {
        $products = $this->productInterface->search($request);
        if ($request->ajax()) {
            $view = view('admin.product.table', compact('products'))->render();
            $paginate = view('admin.pagination.index')->with(['data' => $products])->render();

            return $this->responseSuccess(data: ['html' => $view, 'pagination' => $paginate]);
        }

        return view('admin.product.index', compact('products'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.product.form');
    }

    /**
     * @param ProductRequest $request
     *
     * @return JsonResponse
     */
    public function handle(ProductRequest $request): JsonResponse
    {
        try {
            $this->productInterface->handleProduct($request);

            return $this->responseSuccess(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' sản phẩm thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' sản phẩm thất bại!'));
        }
    }

    /**
     * @param $product
     *
     * @return Application|Factory|View
     */
    public function show($product): View|Factory|Application
    {
        $product = $this->productInterface->show($product);

        return view('admin.product.form', compact('product'));
    }

    /**
     * @param $product
     *
     * @return JsonResponse
     */
    public function delete($product): JsonResponse
    {
        try {
            $this->productInterface->delete($product);

            return $this->responseSuccess(message: __('Đã xóa thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __('Xóa thất bại!'));
        }
    }

    /**
     * @param Request $request
     * @param         $product
     *
     * @return JsonResponse
     */
    public function updateStatus(Request $request, $product): JsonResponse
    {
        try {
            $this->productInterface->updateStatus($request, $product);

            return $this->responseSuccess(message: __('Cập nhật thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __('Cập nhật thất bại!'));
        }
    }
}
