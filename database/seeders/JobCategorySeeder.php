<?php

namespace Database\Seeders;

use Carbon\Traits\Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_category_table')->insert([
            'job_category' => 'tech',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        DB::table('job_category_table')->insert([
            'job_category' => 'health care',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        DB::table('job_category_table')->insert([
            'job_category' => 'hospitality',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        DB::table('job_category_table')->insert([
            'job_category' => 'customer service',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        DB::table('job_category_table')->insert([
            'job_category' => 'marketing',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
    }
}
