<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_mod extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_mod';

    protected $fillable = [
        'code',
        'name',
        'mod_group_id',
        'seq',
        'url',
        'remarks',
        'is_active',
        'is_visible',
    ];

    public $sortable = ['id', 'code', 'name', 'mod_group_id', 'seq', 'url', 'remarks', 'is_active','is_visible',];
    public $sortablaAs = ['mod_group'];
}
