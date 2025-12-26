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
        Schema::create('tb_crm_mf_license', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100);
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('device_id')->nullable();
            $table->date('cache_expiration_date')->nullable();
            $table->unsignedBigInteger('cache_license_type_id')->nullable();
            $table->bigInteger('cache_no_of_license')->nullable();
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
        Schema::dropIfExists('tb_crm_mf_license');
    }
};
