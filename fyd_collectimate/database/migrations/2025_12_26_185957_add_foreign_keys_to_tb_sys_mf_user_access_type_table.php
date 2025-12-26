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
        Schema::table('tb_sys_mf_user_access_type', function (Blueprint $table) {
            $table->foreign(['access_type_id'], 'vantage_user_access_type_access_type_id')->references(['id'])->on('tb_sys_mf_access_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'vantage_user_access_type_user_id')->references(['id'])->on('tb_sys_mf_user')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_sys_mf_user_access_type', function (Blueprint $table) {
            $table->dropForeign('vantage_user_access_type_access_type_id');
            $table->dropForeign('vantage_user_access_type_user_id');
        });
    }
};
