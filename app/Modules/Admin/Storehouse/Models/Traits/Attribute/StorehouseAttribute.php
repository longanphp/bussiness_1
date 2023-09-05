<?php

namespace App\Modules\Admin\Storehouse\Models\Traits\Attribute;

/**
 * Trait StorehouseAttribute
 *
 * @package App\Modules\Admin\Storehouse\Models\Traits\Attribute
 */
trait StorehouseAttribute
{
    public function setNameAttribute(): string
    {
        return $this->name = strtoupper($this->name);
    }
}
