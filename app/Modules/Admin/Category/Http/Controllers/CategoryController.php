<?php

namespace App\Modules\Admin\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Category\Http\Requests\CategoryRequest;
use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected CategoryInterface $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|JsonResponse
     */
    public function index(Request $request): Application|Factory|View|JsonResponse
    {
        $categories = $this->categoryInterface->search($request);
        if ($request->ajax()) {
            $view = view('admin.category.table', compact('categories'))->render();
            $paginate = view('admin.pagination.index')->with(['data' => $categories])->render();

            return $this->responseSuccess(data: ['html' => $view, 'pagination' => $paginate]);
        }

        return view('admin.category.index', compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.category.form');
    }

    /**
     * @param CategoryRequest $request
     *
     * @return JsonResponse
     */
    public function handle(CategoryRequest $request): JsonResponse
    {
        try {
            $this->categoryInterface->handleCategory($request);

            return $this->responseSuccess(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' danh mục thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' danh mục thất bại!'));
        }
    }

    /**
     * @param $category
     *
     * @return Application|Factory|View
     */
    public function show($category): View|Factory|Application
    {
        $category = $this->categoryInterface->show($category);

        return view('admin.category.form', compact('category'));
    }

    /**
     * @param $category
     *
     * @return JsonResponse
     */
    public function delete($category): JsonResponse
    {
        try {
            $this->categoryInterface->delete($category);

            return $this->responseSuccess(message: __('Đã xóa thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __('Xóa thất bại!'));
        }
    }
}
