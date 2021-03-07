<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->string("id")->primary()->unique()->nullable(false);
            $table->string("title")->nullable(false);
            $table->string("company")->nullable(false);
            $table->string("company_logo");
            $table->string("location")->nullable(false);
            $table->integer("category");
            $table->string("salary")->nullable(false);
            $table->text("description")->nullable(false);
            $table->string("benefits");
            $table->integer("type");
            $table->integer("work_condition");
            $table->integer("posted_by");
            $table->timestamps();
            $table->foreign('category')->references("id")->on("job_category_table");
            $table->foreign('type')->references("id")->on("job_type_table");
            $table->foreign("work_condition")->references("id")->on("work_condition_table");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
}
