<?php

namespace App\Modules\Client\Auth\Services;

use App\Models\User;
use App\Modules\Client\Auth\Interfaces\AuthInterface;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AuthService
 */
class AuthService extends BaseService implements AuthInterface
{
    protected MediaInterface $mediaInterface;

    /**
     * AccountAdminService constructor.
     *
     * @param User          $user
     * @param MediaInterface $mediaInterface
     */
    public function __construct(User $user, MediaInterface $mediaInterface)
    {
        $this->model = $user;
        $this->mediaInterface = $mediaInterface;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function login(Request $request): bool
    {
        return Auth::guard('web')->attempt($request->only('phone', 'password'));
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function register(Request $request): Model
    {
        return $this->create($request->all());
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateProfile(Request $request): bool
    {
        $admin = $this->getById(adminInfo()->id());
        $update = $admin->update($request->except('file'));

        return $this->uploadAvatar($update, $request, $admin);
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
                $media = $this->mediaInterface->upload($request->file('avatar'), directory: 'admin');
            }
            if (!empty($media) && $model->hasMedia(Admin::TAG_AVATAR)) {
                $this->mediaInterface->deleteExistingFile($model->getMedia(Admin::TAG_AVATAR)->first());
            }
            empty($media) ?: $model->syncMedia($media, Admin::TAG_AVATAR);

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updatePassword(Request $request): bool
    {
        $admin = $this->getById(adminInfo()->id());

        return $admin->update($request->only('password'));
    }
}
