<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_crm_mf_license extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_crm_mf_license';

    protected $fillable = [
        'code',
        'client_id',
        'device_id',
        'cache_expiration_date',
        'cache_license_type_id',
        'cache_no_of_license',
    ];

    public $sortable = [
        'id',
        'code',
        'client_id',
        'device_id',
        'cache_expiration_date',
        'cache_license_type_id',
        'cache_no_of_license',
    ];
}
