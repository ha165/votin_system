<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'election_id',
        'position_id',
        'party_id',
        'name',
        'student_id',
        'course',
        'manifesto',
        'photo',
    ];

    // Define relationships if needed
    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
