<?php

namespace Database\Seeders;

use Carbon\Traits\Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_type_table')->insert([
            'job_type' => 'full-time',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        DB::table('job_type_table')->insert([
            'job_type' => 'temporary',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        DB::table('job_type_table')->insert([
            'job_type' => 'contract',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        DB::table('job_type_table')->insert([
            'job_type' => 'permanent',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        DB::table('job_type_table')->insert([
            'job_type' => 'internship'
        ]);
        DB::table('job_type_table')->insert([
            'job_type' => 'volunteer'
        ]);
    }
}
