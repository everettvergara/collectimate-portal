<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_sys_mf_mod', function (Blueprint $table) {
            $table->foreign(['mod_group_id'], 'vantage_mod_mod_group_id')->references(['id'])->on('tb_sys_mf_mod_group')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_sys_mf_mod', function (Blueprint $table) {
            $table->dropForeign('vantage_mod_mod_group_id');
        });
    }
};
