<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_register extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_register';

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'email',
        'mobile_no',
        'profile_photo',
        'user_type_id',
        'is_approved',
    ];

    public $sortable = [
        'id',
        'user_id',
        'code',
        'name',
        'email',
        'mobile_no',
        'profile_photo',
        'user_type_id',
        'is_approved',
    ];
}
