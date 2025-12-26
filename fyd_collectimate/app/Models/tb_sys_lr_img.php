<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_lr_img extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_lr_img';

    protected $fillable = [
        'filename',
        'path',
        'table_name',
    ];

    public $sortable = ['id', 'filename', 'path', 'table_name',];
}
