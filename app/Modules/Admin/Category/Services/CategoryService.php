<?php

namespace App\Modules\Admin\Category\Services;

use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use App\Modules\Admin\Category\Models\Category;
use App\Services\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class CategoryService
 *
 * @package App\Modules\Admin\Account\Services
 */
class CategoryService extends BaseService implements CategoryInterface
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handleCategory(Request $request): bool
    {
        if ($request->id) {
           return $this->getById($request->id)->update($request->only('name'));
        }
        return (bool) $this->create($request->only('name'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->model::search($request)->paginate(PAGE_RECORD);
    }

    /**
     * @return mixed
     */
    public function getPublish(): mixed
    {
        return $this->model::getPublish()->get();
    }

    /**
     * @param $category
     *
     * @return bool|null
     * @throws Exception
     */
    public function delete($category): ?bool
    {
        return $this->deleteById($category);
    }

    /**
     * @param $category
     *
     * @return Model
     * @throws Exception
     */
    public function show($category): Model
    {
        return $this->getById($category);
    }
}
