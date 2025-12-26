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
        Schema::create('tb_crm_tr_script', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30);
            $table->string('name', 255);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('license_type_id');
            $table->string('json_file_path', 1000)->nullable();
            $table->string('description', 1000)->nullable();
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
        Schema::dropIfExists('tb_crm_tr_script');
    }
};
