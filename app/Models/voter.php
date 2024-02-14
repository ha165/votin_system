<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class voter extends Model
{
    use HasFactory;
     protected $fillable = ['fullname', 'Student_id', 'course', 'password'];

      public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
