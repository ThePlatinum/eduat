<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
  use HasFactory;


  protected $casts = [
    'class_for' => 'array'
  ];

  protected $fillable = [
    'name', 'description', 'price', 'class_for'
  ];
  
}
