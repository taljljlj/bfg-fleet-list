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
                $names = $modification['value'];
                $modification['module'] = json_encode($modification['module']);
                $modification['value'] = json_encode($modification['value']);
                Modification::create($modification);

                if ($modification['type'] == 'group') {
                    $children = Refit::getByNames($names);
                    $refitObj->children()->attach($children->pluck('id'));
                }
            }
        }
    }
}
