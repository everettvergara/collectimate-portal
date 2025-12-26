<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_user_site extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_user_site';

    protected $fillable = [
        'user_id',
        'site_id',
        'remarks'
    ];

    public $sortable = ['id', 'user_id', 'site_id', 'remarks'];
    public $sortableAs = ['user', 'site'];
}
