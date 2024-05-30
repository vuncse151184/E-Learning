<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    protected $table = "classes";
    use HasFactory;
    protected $fillable = ['id','name'];
   
}
