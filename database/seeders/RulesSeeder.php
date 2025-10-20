<?php

namespace Database\Seeders;

use App\Models\Rules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/rules.json'));
        $rules = json_decode($json, true);

        foreach ($rules as $rule) {
            Rules::create($rule);
        }
    }
}
