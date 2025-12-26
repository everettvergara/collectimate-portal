<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tb_re_mf_brg extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tb_re_mf_brg';

    protected $fillable = [
        'city_id',
        'code',
        'name',
        'remarks',
        'is_active',
    ];

    public $sortable = [
        'id',
        'city_id',
        'code',
        'name',
        'remarks',
        'is_active',
    ];

    public $sortableAs = [
        'city'
    ];

    private function populate()
    {
        return "
        -- Clear existing data
            TRUNCATE TABLE tb_re_mf_province;
            TRUNCATE TABLE tb_re_mf_city;
            TRUNCATE TABLE tb_re_mf_brg;

            -- Insert provinces with unique codes
            INSERT INTO tb_re_mf_province (code, name)
            SELECT DISTINCT CONCAT('PROV_', MD5(TRIM(province))) AS code, TRIM(province) AS name
            FROM fyd10_botejyu.addresses;

            -- Insert cities with unique codes, ensuring they are tied to the correct province
            INSERT INTO tb_re_mf_city (province_id, code, name)
            SELECT DISTINCT
                p.id AS province_id,
                CONCAT('CITY_', MD5(CONCAT(TRIM(a.province), '_', TRIM(a.city)))) AS code,
                TRIM(a.city) AS name
            FROM fyd10_botejyu.addresses a
            JOIN tb_re_mf_province p ON CONCAT('PROV_', MD5(TRIM(a.province))) = p.code;

            -- Insert barangays with unique codes, ensuring they are tied to the correct city
            INSERT INTO tb_re_mf_brg (city_id, code, name)
            SELECT DISTINCT
                c.id AS city_id,
                CONCAT('BRGY_', MD5(CONCAT(TRIM(a.province), '_', TRIM(a.city), '_', TRIM(a.brgy)))) AS code,
                TRIM(a.brgy) AS name
            FROM fyd10_botejyu.addresses a
            JOIN tb_re_mf_province p ON CONCAT('PROV_', MD5(TRIM(a.province))) = p.code
            JOIN tb_re_mf_city c ON c.province_id = p.id AND CONCAT('CITY_', MD5(CONCAT(TRIM(a.province), '_', TRIM(a.city)))) = c.code;

        ";
    }
}
