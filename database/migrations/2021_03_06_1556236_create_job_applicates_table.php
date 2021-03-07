<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicates_table', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("first_name")->nullable(false);
            $table->string("last_name")->nullable(false);
            $table->string("email")->nullable(false)->unique();
            $table->string("phone")->nullable(false)->unique();
            $table->string("location");
            $table->string("cv")->nullable(false);
            $table->string("job_applied_for")->nullable(false);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applicates');
    }
}
