<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkCondition extends Model
{
    use HasFactory;

    protected $table = 'work_condition_table';

    public function jobPost(){
        return $this->hasMany(JobPost::class, 'work_condition', 'id');
    }
}
