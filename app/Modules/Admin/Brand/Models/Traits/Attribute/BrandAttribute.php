<?php

namespace App\Modules\Admin\Brand\Models\Traits\Attribute;

/**
 * Trait BrandAttribute.
 */
trait BrandAttribute
{
    /**
     * @return mixed
     */
    public function getAvatarAttribute(): mixed
    {
        return optional($this->getMedia(self::TAG_AVATAR)->first())->getUrl() ?? asset('admin_assets/images/avatar.jpeg');
    }
}
