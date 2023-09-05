<?php

namespace App\Modules\Client\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Cart\Interfaces\CartInterface;

/**
 * Class CartController
 */
class CartController extends Controller
{
    protected CartInterface $cartInterface;

    /**
     * CartController constructor.
     *
     * @param CartInterface $cartInterface
     */
    public function __construct(CartInterface $cartInterface)
    {
        $this->cartInterface = $cartInterface;
    }

    public function index()
    {
        return view('client.cart.index');
    }

}
