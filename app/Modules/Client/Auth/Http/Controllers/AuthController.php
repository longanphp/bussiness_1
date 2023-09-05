<?php

namespace App\Modules\Client\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Account\Http\Requests\LoginRequest;
use App\Modules\Admin\Account\Http\Requests\UpdatePasswordRequest;
use App\Modules\Admin\Account\Http\Requests\UpdateProfileRequest;
use App\Modules\Client\Auth\Http\Requests\RegisterRequest;
use App\Modules\Client\Auth\Interfaces\AuthInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthController
 */
class AuthController extends Controller
{
    protected AuthInterface $authInterface;

    /**
     * AccountController constructor.
     *
     * @param AuthInterface $authInterface
     */
    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    /**
     * @return Application|Factory|View
     */
    public function loginView(): View|Factory|Application
    {
        return view('client.auth.login');
    }

    /**
     * @return Application|Factory|View
     */
    public function registerView(): View|Factory|Application
    {
        return view('client.auth.register');
    }

    /**
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $auth = $this->authInterface->login($request);
        if ($auth) {
            return redirect()->route('client.home.index');
        }

        return redirect()->back()->with('errorMessage', __('Thông tin tài khoản hoặc mật khẩu không chính xác.'));
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            $this->authInterface->register($request);

            return redirect()->route('client.loginView')->with('success', "Account successfully registered.");
        } catch (\Throwable $e) {
            Log::error('register: ' . $e->getMessage());
            return redirect()->back()->with('errorMessage', __('Đăng ký thất bại.'));
        }
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();

        return redirect()->route('client.loginView');
    }

    /**
     * @return Application|Factory|View
     */
    public function profile(): View|Factory|Application
    {
        return view('admin.profile.index');
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return JsonResponse
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        try {
            $this->accountAdminInterface->updateProfile($request);
            return $this->responseSuccess(message: __('Cập nhật hồ sơ thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return $this->responseFailed(message: __('Cập nhật hồ sơ thất bại!'));
        }
    }

    /**
     * @param UpdatePasswordRequest $request
     *
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        try {
            $this->accountAdminInterface->updatePassword($request);
            return $this->responseSuccess(message: __('Đổi mật khẩu thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return $this->responseFailed(message: __('Đổi mật khẩu thất bại!'));
        }
    }
}
