<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStatistik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->string('id', 40)->primary();
            $table->string('match', 255)->default('0');
            $table->string('win', 255)->default('0');
            $table->string('lose', 255)->default('0');
            $table->string('draw', 255)->default('0');
            $table->string('GM', 255)->default('0');
            $table->string('GL', 255)->default('0');
            $table->string('bulan', 40)->nullable();
            $table->string('poin', 255)->default('0');
            $table->string('user_id', 40);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistik');
    }
}
