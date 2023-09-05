<?php

namespace App\Modules\Client\Cart\Services;

use App\Models\User;
use App\Modules\Client\Cart\Interfaces\CartInterface;
use App\Services\BaseService;

/**
 * CartService
 */
class CartService extends BaseService implements CartInterface
{
    /**
     * CartService constructor.
     *
     * @param User          $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
