<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_crm_mf_license_history extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_crm_mf_license_history';

    protected $fillable = [
        'license_id',
        'device_id',
        'expiration_date',
        'license_type_id',
        'no_of_license',
    ];

    public $sortable = [
        'id',
        'license_id',
        'device_id',
        'expiration_date',
        'license_type_id',
        'no_of_license',
    ];
}
