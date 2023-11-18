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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id('lesson_id');
            $table->smallInteger('reference_id')->nullable(true);
            $table->smallInteger('reference_order_no')->nullable(true);
            $table->string('lesson_name',255)->nullable(true);
            $table->dateTime('lesson_created_at');
            $table->dateTime('lesson_updated_at')->nullable(true);
            $table->dateTime('lesson_deleted_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};
