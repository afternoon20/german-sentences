<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reference;


class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=ReferenceSeeder
        $referenceList = [
            'しっかり身につくドイツ語トレーニングブック',
        ];

        foreach($referenceList as $referenceName){
            $reference = new Reference();
            $reference->reference_name = $referenceName;
            $reference->save();
        }
    }
}
