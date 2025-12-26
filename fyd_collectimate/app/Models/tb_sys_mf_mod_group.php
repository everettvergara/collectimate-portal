<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_mod_group extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_mod_group';

    protected $fillable = [
        'code',
        'name',
        'parent_mod_group_id',
        'seq',
        'remarks',
        'is_active',
    ];

    public $sortable = ['id', 'code', 'name', 'parent_mod_group_id', 'remarks', 'is_active'];

    public $sortableAs = ['parent_mod_group'];
}
