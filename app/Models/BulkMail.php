<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkMail extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 'klass_id', 'to', 'content', 'subject'
    ];
  
    public function user()
    {
      return $this->hasOne(User::class, 'id', 'user_id');
    }
  
    public function class()
    {
      return $this->hasOne(Klass::class, 'id', 'klass_id');
    }
}
