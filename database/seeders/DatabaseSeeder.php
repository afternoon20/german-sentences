<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Reference;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReferenceSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(QuestionSeeder::class);
    }
}
