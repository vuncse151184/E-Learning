<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function questionOptions(){
       return $this->hasMany(QuestionOption::class);
    }


    protected $fillable = ['results','question_name'];

    protected $casts = [
        'options' => 'array',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id','id');
    }
}
