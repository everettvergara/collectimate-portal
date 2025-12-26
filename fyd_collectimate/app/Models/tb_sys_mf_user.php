<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class tb_sys_mf_user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    protected $table = 'tb_sys_mf_user';

    protected $fillable = [
        'code',
        'name',
        'email',
        'password',
        'is_active',
        'mobile_no',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
