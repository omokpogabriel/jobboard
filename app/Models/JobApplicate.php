<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicate extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name', 'email','phone', 'location' ,'cv','job_id'];

    protected $table = 'job_applicates_table';

    public function jobposts(){
        return $this->belongsTo(JobPost::class,'job_id','id');
    }
}
