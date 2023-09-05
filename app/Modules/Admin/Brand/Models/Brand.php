<?php

namespace App\Modules\Admin\Brand\Models;

use App\Modules\Admin\Brand\Models\Traits\Attribute\BrandAttribute;
use App\Modules\Admin\Brand\Models\Traits\Scope\BrandScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Brand extends Model
{
    use HasFactory, BrandScope, Mediable, BrandAttribute;

    protected $table = 'brands';

    protected $fillable = [
        'name'
    ];

    protected $with = [
        'media'
    ];

    public const TAG_AVATAR = 'avatar';
    public const PUBLISH = 3;
}
