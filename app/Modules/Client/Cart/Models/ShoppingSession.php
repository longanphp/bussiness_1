<?php

namespace App\Modules\Client\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingSession extends Model
{
    use HasFactory;

    protected $table = 'shopping_sessions';

    protected $fillable = [
        'user_id',
        'quantity_total',
        'price_total'
    ];
}
