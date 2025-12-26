<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_style extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_style';

    protected $fillable = [
        'code',
        'name',
        'width',
        'height',
        'path',
    ];

    public $sortable = ['id', 'code', 'name', 'width', 'height', 'path',];
}
