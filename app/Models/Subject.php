<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['id','class_id','name'];
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function className(){
        return $this->hasOne(ClassName::class,'id');
    }

}
