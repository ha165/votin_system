<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $tables = 'elections';

    protected $fillable = [
        'title',
        'status',
        'description',
        'start',
        'end',
     ];

     //relationships
     
     protected $dates = ['start','end'];
}
