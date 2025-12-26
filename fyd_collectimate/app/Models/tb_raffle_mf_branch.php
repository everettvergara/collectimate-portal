<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_raffle_mf_branch extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_raffle_mf_branch';

    protected $fillable = [
        'code',
        'name',
        'tin',
        'remarks',
        'is_active',
    ];

    public $sortable = [
        'id',
        'code',
        'name',
        'tin',
        'remarks',
        'is_active',
    ];
}
