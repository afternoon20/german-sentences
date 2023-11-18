<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SplFileObject;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // NOTE: php artisan db:seed --class=LessonSeeder
        $file = new SplFileObject(storage_path() .'/app/private/import/lesson.csv');
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        foreach ($file as $line) {
            $line = mb_convert_encoding($line, 'UTF-8');
            $lesson = new Lesson();
            $lesson->reference_id = $line[0];
            $lesson->reference_order_no = $line[1];
            $lesson->lesson_name = $line[2];
            $lesson->save();
        }
    }
}
