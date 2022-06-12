<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'firstname', 'lastname', 'othername',
    'email', 'phone', 'address',
    'gender', 'dob',
    'password', 'klass_id', 
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'dob' => 'datetime',
  ];

  public function getFullnameAttribute(){
    return $this->firstname .' '. $this->lastname .' '. $this->othername;
  }

  public function class(){
    return $this->belongsTo(Klass::class, 'klass_id');
  }

  public function payments(){
    return $this->hasMany(Payments::class, 'student_id');
  }

  public function items(){
    return $this->hasManyThrough(Items::class, Studentitems::class, 'student_id', 'id', 'id', 'item_id');
  }

  public function getPaidAttribute(){
    return $this->payments()->sum('ammount');
  }

  public function studentclasses(){
    return $this->hasMany(StudentClasses::class, 'student_id');
  }

  public function sums(){
    $classes = $this->studentclasses()->get();
    $fees_sum = 0;
    foreach ($classes as $class ) {
      $c = Klass::find($class->class_id);
      $fees_sum += $c->fees_sum;
    }
    return $fees_sum;
  }

  public function getShouldPayAttribute(){
    $items_costs = $this->items()->sum('price');
    $class_cost = $this->sums();
    return ($items_costs + $class_cost) - $this->paid;
  }

  protected $appends = [
    'fullname', 'paid', 'should_pay'
  ];

}
