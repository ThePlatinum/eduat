<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
  use HasFactory;

  protected $fillable = [
    'name', 'fees',
  ];

  protected $casts = [
    'fees' => 'array'
  ];

  public function students()
  {
    return $this->hasMany(User::class, 'current_class');
  }

  public function subjects()
  {
    return $this->hasMany(Subjects::class, 'class_id');
  }

  public function teacher()
  {
    return $this->hasOneThrough(User::class, ClassTeacher::class, 'class_id', 'id', 'id', 'teacher_id');
  }
  
}
