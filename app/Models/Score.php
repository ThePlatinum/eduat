<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
  use HasFactory;

  protected $fillable = [
    'assessment_id', 'user_id', 'score', 'remarks'
  ];

  public function assessment() {
    return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
  }
}
