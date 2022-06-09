<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
  use HasFactory;

  protected $fillable = [
    'subject_id', 'class_id',
    'type', 'cesion_id', 'term_id',
    'title', 'grade_point', 'assessed_at'
  ];

  protected $casts = [
    'assessed_at' => 'datetime',
  ];

  public function subject()
  {
    return $this->belongsTo(Subjects::class);
  }

  public function scores()
  {
    return $this->hasMany(Score::class);
  }

  public function getHighestScoreAttribute()
  {
    return $this->scores()->max('score');
  }

  public function getLowestScoreAttribute()
  {
    return $this->scores()->min('score');
  }

  public function getAverageScoreAttribute()
  {
    return $this->scores()->avg('score');
  }

  protected $appends = [
    'highest_score', 'lowest_score', 'average_score'
  ];
}
