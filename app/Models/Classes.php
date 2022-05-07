<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
  use HasFactory;

  protected $fillable = [
    'name', 'level', 'fees',
  ];

  protected $casts = [
    'fees' => 'array'
  ];

  public function students()
  {
    return $this->hasMany(StudentClasses::class, 'class_id');
  }

  public function subjects()
  {
    return $this->hasMany(Subjects::class, 'class_id');
  }
}
