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
        Schema::create('tb_sys_mf_mod_group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30);
            $table->string('name', 255);
            $table->unsignedBigInteger('parent_mod_group_id')->nullable()->index('vantage_mod_group_parent_mod_group_id_idx');
            $table->string('remarks', 1000)->nullable();
            $table->integer('seq')->nullable();
            $table->boolean('is_active')->nullable();
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
        Schema::dropIfExists('tb_sys_mf_mod_group');
    }
};
