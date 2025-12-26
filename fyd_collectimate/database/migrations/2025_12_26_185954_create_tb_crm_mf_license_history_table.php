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
        Schema::create('tb_crm_mf_license_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->date('expiration_date');
            $table->unsignedBigInteger('license_type_id');
            $table->bigInteger('no_of_license')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_crm_mf_license_history');
    }
};
