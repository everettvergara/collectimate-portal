<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_re_mf_province extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_re_mf_province';

    protected $fillable = [
        'code',
        'name',
        'remarks',
        'is_active',
    ];

    public $sortable = [
        'id',
        'code',
        'name',
        'remarks',
        'is_active',
    ];
}
