<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klass extends Model
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
    return $this->hasMany(User::class, 'klass_id');
  }

  public function subjects()
  {
    return $this->hasMany(Subjects::class, 'class_id');
  }

  public function teacher()
  {
    return $this->hasOneThrough(User::class, ClassTeacher::class, 'class_id', 'id', 'id', 'teacher_id');
  }
  
  public function getStudentCountAttribute() {
    return $this->students()->count();
  }

  protected $appends = [
    'student_count'
  ];
}
