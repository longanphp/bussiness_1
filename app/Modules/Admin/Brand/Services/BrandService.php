<?php

namespace App\Modules\Admin\Brand\Services;

use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class BrandService
 *
 * @package App\Modules\Admin\Category\Services
 */
class BrandService extends BaseService implements BrandInterface
{
    protected MediaInterface $mediaInterface;

    public function __construct(Brand $brand, MediaInterface $mediaInterface)
    {
        $this->model = $brand;
        $this->mediaInterface = $mediaInterface;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handleBrand(Request $request): bool
    {
        if ($request->id) {
            $handle = $this->getById($request->id);
            $handle->update($request->only('name'));
        } else {
            $handle = $this->create($request->only('name'));
        }
        return $this->uploadAvatar($handle, $request, $handle);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->model::search($request)->paginate(PAGE_RECORD);
    }

    /**
     * @return mixed
     */
    public function getPublish(): mixed
    {
        return $this->model::getPublish()->get();
    }

    /**
     * @param $brand
     *
     * @return bool|null
     * @throws Exception
     */
    public function delete($brand): ?bool
    {
        $brand = $this->getById($brand);
        $this->mediaInterface->deleteExistingFile($brand->getMedia(Brand::TAG_AVATAR)->first());
        return $brand->delete();
    }

    /**
     * @param $brand
     *
     * @return Model
     * @throws Exception
     */
    public function show($brand): Model
    {
        return $this->getById($brand);
    }

    /**
     * @param $update
     * @param $request
     * @param $model
     *
     * @return bool
     */
    private function uploadAvatar($update, $request, $model): bool
    {
        if ($update) {
            if ($request->hasFile('avatar')) {
                $media = $this->mediaInterface->upload($request->file('avatar'), directory: 'brand');
            }
            if (!empty($media) && $model->hasMedia(Brand::TAG_AVATAR)) {
                $this->mediaInterface->deleteExistingFile($model->getMedia(Brand::TAG_AVATAR)->first());
            }
            empty($media) ?: $model->syncMedia($media, Brand::TAG_AVATAR);

            return true;
        }

        return false;
    }
}
