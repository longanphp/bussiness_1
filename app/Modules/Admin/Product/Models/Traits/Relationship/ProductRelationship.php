<?php

namespace App\Modules\Admin\Product\Models\Traits\Relationship;

use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Admin\Category\Models\Category;
use App\Modules\Admin\Storehouse\Models\Storehouse;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ProductRelationship
{
    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return HasMany
     */
    public function storehouses(): HasMany
    {
        return $this->hasMany(Storehouse::class);
    }
}
