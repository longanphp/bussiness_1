<?php

namespace App\Modules\Admin\Account\Models;

use App\Modules\Admin\Account\Models\Traits\Attribute\AdminAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Plank\Mediable\Mediable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Mediable, AdminAttribute;

    protected string $guard = 'admin';

    protected $hidden = ['password'];

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'email',
        'password',
    ];

    public const TAG_AVATAR = 'avatar';
}
