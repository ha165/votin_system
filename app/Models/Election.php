<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $table = 'elections';

    protected $fillable = [
        'title',
        'status',
        'description',
        'start',
        'end',
    ];

    // Define the dates that should be treated as Carbon instances
    protected $dates = ['start', 'end'];

    // Define relationships
     public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}
