<?php

namespace App\Modules\Admin\Storehouse\Services;

use App\Modules\Admin\Storehouse\Interfaces\StorehouseInterface;
use App\Modules\Admin\Storehouse\Models\Storehouse;
use App\Services\BaseService;
use Illuminate\Http\Request;

/**
 * Class StorehouseService
 *
 * @package App\Modules\Admin\Storehouse\Services
 */
class StorehouseService extends BaseService implements StorehouseInterface
{
    public function __construct(Storehouse $category)
    {
        $this->model = $category;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handleStorehouse(Request $request): bool
    {
        if ($request->id) {
           return $this->getById($request->id)->update($request->only($this->fillable()));
        }
        return (bool) $this->create($request->only($this->fillable()));
    }

    /**
     * @param $data
     *
     * @return bool
     */
    public function insertStorehouse($data): bool
    {
        return $this->insert($data);
    }
}
