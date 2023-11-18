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
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->smallInteger('question_lesson_id')->nullable(false);
            $table->string('question_question',255)->nullable(false);
            $table->string('question_answer',255)->nullable(false);
            $table->smallInteger('question_page')->nullable(false);
            $table->smallInteger('question_is_valid')->nullable(false)->default(1);
            $table->smallInteger('question_correct')->nullable(false)->default(0);
            $table->smallInteger('question_incorrect')->nullable(false)->default(0);
            $table->dateTime('question_created_at');
            $table->dateTime('question_updated_at')->nullable(true);
            $table->dateTime('question_deleted_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
