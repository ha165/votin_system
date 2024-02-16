<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\Party;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('pages.candidates.index',compact('candidates'));
    }
    public function create()
    {
        $elections = Election::all();
        $parties = Party::all();
        $positions = Position::all();
        return view('pages.candidates.add',compact('elections','parties','positions'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'student_id'=> 'required|string|max:255',
            'manifesto'=>'required|string|max:255',
            'position_id' => 'required|exists:positions,id', //  position_id exists in the positions table
            'party_id' => 'required|exists:parties,id', // party_id exists in the parties table
            'election_id' => 'required|exists:elections,id', // election_id exists in the elections table
            'created_at' => 'required|date',
        ]);
        
        // Check if the candidate has already registered for the position in the current election
        $existingCandidate = Candidate::where('student_id', $validatedData['student_id'])
            ->where('position_id', $validatedData['position_id'])
            ->where('election_id', $validatedData['election_id'])
            ->first();
    
        if ($existingCandidate) {
            // Candidate has already registered for this position in the current election
            // You can return an error response or redirect back with an error message
            return redirect()->route('candidates')->with('error', 'You have already registered for this position in the current election.');
        }
        
        // Handle file upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }
        
        // Create the candidate
        Candidate::create($validatedData);
        
        return redirect()->route('candidates')->with('success', 'New candidate added successfully.');
    }
}