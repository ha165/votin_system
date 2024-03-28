<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $table = 'votes';

    protected $fillable = ['voter_id', 'election_id', 'position_id', 'candidate_id', 'parties_id'];

    public function votes()
    {
        return $this->belongsTo(User::class, 'voter_id', 'id');
    }
    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id', 'id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
}
