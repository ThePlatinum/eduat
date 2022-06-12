<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payments extends Model
{
  use HasFactory;

  protected $casts = [
    'paydate' => 'datetime',
  ];

  protected $fillable = [
    'student_id', 'paid_in_class_id', 'paid_in_term_id', 'receipt_number', 'ammount', 'note', 'paydate'
  ];

  public function class(){
    return $this->hasOne(Klass::class, 'id', 'paid_in_class_id');
  }
}
