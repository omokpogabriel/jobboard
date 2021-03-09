<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'company','company_logo','location', 'category'
        ,'salary', 'description', 'benefits', 'type', 'work_condition', 'posted_by'
    ];

    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'posted_by'
    ];

//    public function work_station(){
//        return $this->belongsTo(WorkCondition::class, 'id','work_condition');
//    }


    public  function applicates(){
        return $this->hasMany(JobApplicate::class,'job_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'posted_by', 'id');
    }
}
