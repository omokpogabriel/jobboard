<?php

namespace Tests\Feature;

use App\Models\JobCategory;
use App\Models\JobCategory as Jobs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobCategoryTest extends TestCase
{

    private $job_category;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_job_category()
    {
        $value = 'tech';
        $response = in_array(strtolower($value), $this->job_category);


        $this->assertFalse($response);
//        $response->assertTrue($this->job_category);
    }


    public function __construct(){
          $this->job_category = Jobs::pluck('job_category')->toArray();
    }
}
