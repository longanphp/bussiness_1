<?php

namespace App\Modules\Admin\Brand\Interfaces;
use Illuminate\Http\Request;

/**
 * Interface BrandInterface
 *
 * @package App\Modules\Admin\Category\Interfaces
 */
interface BrandInterface
{
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handleBrand(Request $request): bool;

    /**
     * @param Request $request
     */
    public function search(Request $request);

    /**
     * @return mixed
     */
    public function getPublish(): mixed;

    /**
     * @param $brand
     *
     * @return mixed
     */
    public function delete($brand): mixed;

    /**
     * @param $brand
     *
     * @return mixed
     */
    public function show($brand): mixed;
}
