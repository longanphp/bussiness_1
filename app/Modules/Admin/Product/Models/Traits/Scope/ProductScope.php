<?php

namespace App\Modules\Admin\Product\Models\Traits\Scope;

use DateTime;

/**
 * Trait ProductScope
 *
 * @package App\Modules\Admin\Product\Models\Traits\Scope
 */
trait ProductScope
{
    /**
     * @param $query
     * @param $request
     *
     * @return mixed
     */
    public function scopeSearch($query, $request): mixed
    {
        return $query->when(
            !empty($request->key_search),
            function ($q) use ($request) {
                $q->where('name', 'like', '%'.escapeLike($request->key_search).'%');
            }
        )->when(
            !empty($request->brand_id),
            function ($q) use ($request) {
                $q->where('brand_id', $request->brand_id);
            }
        )->when(
            !empty($request->category_id),
            function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            }
        )->when(
            isset($request->status),
            function ($q) use ($request) {
                $q->where('status', $request->status);
            }
        )->when(
            !empty($request->start_date) || !empty($request->end_date),
            function ($q) use ($request) {
                if (!empty($request->start_date) && !empty($request->end_date)) {
                    $q->whereBetween('created_at', [convertDateToDateTime($request->start_date), convertDateToDateTime($request->end_date)]);
                } elseif (!empty($request->start_date)) {
                    $q->where('created_at', '>=', convertDateToDateTime($request->start_date));
                } elseif (!empty($request->end_date)) {
                    $q->where('created_at', '<=', convertDateToDateTime($request->end_date));
                }
            }
        );
    }

    /**
     * @param     $query
     * @param int $limit
     *
     * @return mixed
     */
    public function scopeGetIsFeatured($query, int $limit = 8): mixed
    {
        return $query->where('is_featured', ACTIVE)->limit($limit)->get();
    }

    /**
     * @param $query
     * @param $slug
     *
     * @return mixed
     */
    public function scopeGetBySlug($query, $slug): mixed
    {
        return $query->where('slug', $slug)->where('status', ACTIVE)->first();
    }
}
