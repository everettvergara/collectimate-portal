<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_re_mf_city extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_re_mf_city';

    protected $fillable = [
        'province_id',
        'code',
        'name',
        'remarks',
        'is_active',
    ];

    public $sortable = [
        'id',
        'province_id',
        'code',
        'name',
        'remarks',
        'is_active',
    ];

    public $sortableAs = [
        'province'
    ];
}
