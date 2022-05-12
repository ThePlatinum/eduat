<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
  use HasFactory;

  protected $fillable = [
    'student_id', 'class_id', 'receipt_number', 'ammount', 'note',
  ];
}
