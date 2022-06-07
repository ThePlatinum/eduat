<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'class_id', 'teacher_id',
    ];

    public function teacher()
    {
      return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function class(){
      return $this->belongsTo(Klass::class, 'class_id');
    }
}
