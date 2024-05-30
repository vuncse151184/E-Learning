<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable=[
        'question_list',
        'teacher_id',
        'video',
        'is_public',
        'lesson_name',
        'subject_id',
        'lesson_url',
        'content',
        'tag_list'
    ];

    protected $casts = [
        'tag_list' => 'array',
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    
    public function subject(){
        return $this->hasOne(Subject::class,'id');
    }
}
