<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question2rates', function (Blueprint $table) {
            $table->smallInteger('rate_question_id')->nullable(false);
            $table->smallInteger('rate_user_id')->nullable(false);
            $table->smallInteger('rate_correct')->nullable(false)->default(0);
            $table->smallInteger('rate_incorrect')->nullable(false)->default(0);
            $table->dateTime('rate_created_at');
            $table->dateTime('rate_updated_at')->nullable(true);
            $table->primary(['rate_question_id', 'rate_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question2rates');
    }
};
