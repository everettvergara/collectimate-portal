<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_lr_img_style extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_lr_img_style';

    protected $fillable = [
        'img_id',
        'style_id',
    ];

    public $sortable = ['id', 'img_id', 'style_id'];
    public $sortableAs = ['Image', 'Style'];
}
