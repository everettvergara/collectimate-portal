<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_user_type extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_user_type';

    protected $fillable = [
        'code',
        'name',
        'remarks',
        'is_active',
    ];

    public $sortable = ['id', 'code', 'name', 'remarks', 'is_active'];
}
