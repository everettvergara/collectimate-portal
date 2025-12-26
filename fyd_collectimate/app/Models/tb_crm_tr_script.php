<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_crm_tr_script extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_crm_tr_script';

    protected $fillable = [
        'code',
        'name',
        'client_id',
        'license_type_id',
        'description',
        'json_file_path',
    ];

    public $sortable = [
        'id',
        'code',
        'name',
        'client_id',
        'license_type_id',
        'description',
        'json_file_path',
    ];

    public $sortableAs = [
        'client',
        'license_type',
    ];
}
