<?php

namespace App\Modules\Admin\Category\Models;

use App\Modules\Admin\Category\Models\Traits\Scope\CategoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CategoryScope;

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    public const PUBLISH = 3;
}
