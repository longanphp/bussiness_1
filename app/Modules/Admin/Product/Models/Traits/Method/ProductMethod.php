<?php

namespace App\Modules\Admin\Product\Models\Traits\Method;

use Illuminate\Database\Eloquent\Collection;

/**
 * Trait ProductMethod.
 */
trait ProductMethod
{
    /**
     * @param $ids
     *
     * @return Collection
     */
    public function getSubImageByIdMethod($ids): Collection
    {
        return $this->media()->whereIn('id', $ids)->get();
    }
}
