<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Tag extends Model
{
    use HasFactory;
    protected $casts = [
        'class_id' => 'array',
    ];
    protected $fillable = ['id','name','class_id'];
    public $timestamps = false;
   
}
