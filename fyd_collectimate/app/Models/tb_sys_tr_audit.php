<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_tr_audit extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_tr_audit';

    protected $fillable = [
        'user_id',
        'module',
        'remarks',
        'timestamp',
    ];


    protected $sortable = [
        'id',
        'user_id',
        'module',
        'remarks',
        'timestamp',
    ];

    protected $sortableAs = [
        'user'
    ];
}
