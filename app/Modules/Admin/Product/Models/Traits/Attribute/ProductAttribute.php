<?php

namespace App\Modules\Admin\Product\Models\Traits\Attribute;

use Illuminate\Support\Collection;

/**
 * Trait ProductAttribute.
 */
trait ProductAttribute
{
    /**
     * @return mixed
     */
    public function getAvatarAttribute(): mixed
    {
        return optional($this->getMedia(self::TAG_AVATAR)->first())->getUrl() ?? asset(
                'admin_assets/images/avatar.jpeg'
            );
    }

    /**
     * @return mixed
     */
    public function getSubImageAttribute(): mixed
    {
        $result = $this->getMedia(self::TAG_SUB_IMAGE);

        return $result->map(
            function ($data) {
                return [
                    'id'  => $data->id,
                    'url' => $data->getUrl(),
                ];
            }
        );
    }

    /**
     * @return Collection
     */
    public function getStatusActionAttribute(): Collection
    {
        $data = collect();
        switch ($this->status) {
            case INACTIVE:
                $data->msg = __('Tạm dừng');
                $data->class = 'text-danger';
                $data->btn = 'btn-success';
                $data->text_btn = __('Hiển thị trên web');
                $data->status = ACTIVE;
                break;
            case ACTIVE:
                $data->msg = __('Đang bán');
                $data->class = 'text-success';
                $data->btn = 'btn-secondary';
                $data->text_btn = __('Dừng bán');
                $data->status = INACTIVE;
                break;
        };

        return $data;
    }

    /**
     * @return string
     */
    public function getQuantityAttribute(): string
    {
        $count = 0;
        if ($this->storehouses->count()) {
            $count = $this->storehouses->sum('quantity');
        }

        return $count;
    }
}
