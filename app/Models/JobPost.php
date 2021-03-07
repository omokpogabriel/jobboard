<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    public function work_station(){
        return $this->belongsTo(WorkCondition::class, 'id','work_condition');
    }
}
