<?php

namespace App\Modules\Admin\Product\Models;

use App\Modules\Admin\Product\Models\Traits\Attribute\ProductAttribute;
use App\Modules\Admin\Product\Models\Traits\Method\ProductMethod;
use App\Modules\Admin\Product\Models\Traits\Relationship\ProductRelationship;
use App\Modules\Admin\Product\Models\Traits\Scope\ProductScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

/**
 * Class Product
 *
 * @package App\Modules\Admin\Product\Models
 */
class Product extends Model
{
    use HasFactory, Mediable, ProductScope, ProductAttribute, ProductRelationship, ProductMethod;

    protected $table = 'products';

    public $fillable = [
        'brand_id',
        'category_id',
        'name',
        'slug',
        'status',
        'description',
        'price',
        'is_featured',
        'introduce',
    ];

    protected $with = [
        'category',
        'brand',
        'storehouses',
        'media'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'media'
    ];

    public const TAG_AVATAR = 'avatar';
    public const TAG_SUB_IMAGE = 'sub_image';
}
