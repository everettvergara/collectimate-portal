<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_sys_mf_register_partner extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_sys_mf_register_partner';

    protected $fillable = [
        'user_id',
        'entity_id',
        'code',
        'name',
        'website',
        'tin_no',
        'cp_first_name',
        'cp_last_name',
        'email',
        'mobile_no',
        'designation',
        'password',
        'is_approved',
        'is_cancelled'
    ];

    public $sortable = [
        'id',
        'user_id',
        'entity_id',
        'code',
        'name',
        'website',
        'tin_no',
        'cp_first_name',
        'cp_last_name',
        'email',
        'mobile_no',
        'designation',
        'password',
        'is_approved',
        'is_cancelled'
    ];
}
