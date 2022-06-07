<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentitems extends Model
{
  use HasFactory;

  protected $fillable = [
    'item_id', 'student_id', 'class_id'
  ];
}