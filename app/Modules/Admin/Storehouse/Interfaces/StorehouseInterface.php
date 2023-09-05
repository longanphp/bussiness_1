<?php

namespace App\Modules\Admin\Storehouse\Interfaces;
use Illuminate\Http\Request;

/**
 * Interface StorehouseInterface
 *
 * @package App\Modules\Admin\Storehouse\Interfaces
 */
interface StorehouseInterface
{
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handleStorehouse(Request $request): bool;

    /**
     * @param $data
     *
     * @return bool
     */
    public function insertStorehouse($data): bool;
}
