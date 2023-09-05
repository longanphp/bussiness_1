<?php

namespace App\Modules\Admin\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Brand\Http\Requests\BrandRequest;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    protected BrandInterface $brandInterface;

    public function __construct(BrandInterface $brandInterface)
    {
        $this->brandInterface = $brandInterface;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|JsonResponse
     */
    public function index(Request $request): Application|Factory|View|JsonResponse
    {
        $brands = $this->brandInterface->search($request);
        if ($request->ajax()) {
            $view = view('admin.brand.table', compact('brands'))->render();
            $paginate = view('admin.pagination.index')->with(['data' => $brands])->render();

            return $this->responseSuccess(data: ['html' => $view, 'pagination' => $paginate]);
        }

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.brand.form');
    }

    /**
     * @param BrandRequest $request
     *
     * @return JsonResponse
     */
    public function handle(BrandRequest $request): JsonResponse
    {
        try {
            $this->brandInterface->handleBrand($request);

            return $this->responseSuccess(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' nhãn hiệu thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' nhãn hiệu thất bại!'));
        }
    }

    /**
     * @param $brand
     *
     * @return Application|Factory|View
     */
    public function show($brand): View|Factory|Application
    {
        $brand = $this->brandInterface->show($brand);

        return view('admin.brand.form', compact('brand'));
    }

    /**
     * @param $brand
     *
     * @return JsonResponse
     */
    public function delete($brand): JsonResponse
    {
        try {
            $this->brandInterface->delete($brand);

            return $this->responseSuccess(message: __('Đã xóa thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __('Xóa thất bại!'));
        }
    }
}
