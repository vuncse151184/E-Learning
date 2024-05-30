<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'teachers';

    protected $guard = 'teacher';

    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'phone', 'password','is_active','image','birthday','gender'];

    use HasFactory;


    public function lessons(){
        $this->hasMany(Lesson::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
