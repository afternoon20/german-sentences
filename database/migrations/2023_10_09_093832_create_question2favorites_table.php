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
        Schema::create('question2favorites', function (Blueprint $table) {
            $table->smallInteger('favorite_question_id')->nullable(false);
            $table->smallInteger('favorite_user_id')->nullable(false);
            $table->dateTime('favorite_created_at');
            $table->dateTime('favorite_updated_at')->nullable(true);
            $table->primary(['favorite_question_id', 'favorite_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question2favorites');
    }
};
