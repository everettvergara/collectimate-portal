<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_crm_mf_client_device extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_crm_mf_client_device';

    protected $fillable = [
        'client_id',
        'code',
        'name',
        'client_key',
        'remarks',
        'is_active',
    ];

    public $sortable = [
        'id',
        'client_id',
        'code',
        'name',
        'client_key',
        'remarks',
        'is_active',
    ];
}
