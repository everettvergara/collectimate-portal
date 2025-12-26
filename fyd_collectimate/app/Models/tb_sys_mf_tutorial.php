<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_sys_mf_tutorial extends Model
{
    use HasFactory;

    protected $table = 'tb_sys_mf_tutorial';

    protected $fillable = [
        'description',
    ];
}
