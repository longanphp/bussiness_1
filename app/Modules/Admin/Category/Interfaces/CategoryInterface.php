<?php

namespace App\Modules\Admin\Category\Interfaces;
use Illuminate\Http\Request;

/**
 * Interface CategoryInterface
 *
 * @package App\Modules\Admin\Category\Interfaces
 */
interface CategoryInterface
{
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handleCategory(Request $request): bool;

    /**
     * @param Request $request
     */
    public function search(Request $request);

    /**
     * @return mixed
     */
    public function getPublish(): mixed;

    /**
     * @param $category
     *
     * @return mixed
     */
    public function delete($category): mixed;

    /**
     * @param $category
     *
     * @return mixed
     */
    public function show($category): mixed;
}
