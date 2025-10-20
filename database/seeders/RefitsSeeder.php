<?php

namespace Database\Seeders;

use App\Models\Modification;
use App\Models\Refit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/refits.json'));
        $refits = json_decode($json, true);

        foreach ($refits as $refit) {
            $modifications = $refit['data'];
            unset($refit['data']);
            $refitObj = Refit::create($refit);
            foreach ($modifications as $modification) {
                $modification['refit_id'] = $refitObj->id;
                Modification::create($modification);

                if ($modification['type'] == 'group') {
                    $names = json_decode($modification['value'], false);
                    $children = Refit::getByNames($names);
                    $refitObj->children()->attach($children->pluck('id'));
                }
            }
        }
    }
}
