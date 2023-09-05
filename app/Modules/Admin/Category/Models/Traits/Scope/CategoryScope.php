<?php

namespace App\Modules\Admin\Category\Models\Traits\Scope;

/**
 * Trait CategoryScope
 *
 * @package App\Modules\Admin\Category\Models\Traits\Scope
 */
trait CategoryScope
{
    /**
     * @param $query
     * @param $request
     * @return mixed
     */
    public function scopeSearch($query, $request): mixed
    {
        return $query->when(!empty($request->key_search), function ($q) use ($request) {
            $q->where('name', 'like', '%' . escapeLike($request->key_search) . '%');
        });
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetPublish($query): mixed
    {
        return $query->where('status', self::PUBLISH);
    }
}
