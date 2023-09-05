<?php

namespace App\Modules\Admin\Storehouse\Models;

use App\Modules\Admin\Storehouse\Models\Traits\Attribute\StorehouseAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storehouse extends Model
{
    use HasFactory, StorehouseAttribute;

    protected $table = 'storehouse';

    protected $fillable = [
        'name',
        'product_id',
        'quantity'
    ];
}
