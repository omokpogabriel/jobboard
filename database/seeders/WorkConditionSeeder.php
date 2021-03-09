<?php

namespace Database\Seeders;

use Carbon\Traits\Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_condition_table')->insert([
            'work_condition' => 'remote',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        DB::table('work_condition_table')->insert([
            'work_condition' =>'part remote',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        DB::table('work_condition_table')->insert([
            'work_condition' =>'on-premise',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
    }
}
