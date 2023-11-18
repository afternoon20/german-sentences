<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use SplFileObject;
use Illuminate\Database\Seeder;
use App\Models\Question;


class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // NOTE: php artisan db:seed --class=QuestionSeeder
        $file = new SplFileObject(storage_path() .'/app/private/import/questions.csv');
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        foreach ($file as $line) {
            $line = mb_convert_encoding($line, 'UTF-8');
            $question = new Question();
            $question->question_lesson_id = $line[0];
            $question->question_question = $line[1];
            $question->question_answer = $line[2];
            $question->question_page = $line[3];
            $question->question_is_valid = 1;
            $question->save();
        }
    }
}
