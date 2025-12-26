<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_status extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_status';

    protected $fillable = [
        'code',
        'name',
        'is_active'
    ];

    public $sortable = ['id', 'code', 'name', 'is_active'];
}
