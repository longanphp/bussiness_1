<?php

namespace App\Modules\Client\Auth\Interfaces;
use Illuminate\Http\Request;

/**
 * AuthInterface
 */
interface AuthInterface
{
    /**
     * @param Request $request
     */
    public function login(Request $request);

    /**
     * @param Request $request
     */
    public function register(Request $request);

    /**
     * @param Request $request
     */
    public function updateProfile(Request $request);


    /**
     * @param Request $request
     */
    public function updatePassword(Request $request);
}
