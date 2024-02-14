<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
        return view('pages.candidates.add');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id', //  position_id exists in the positions table
            'party_id' => 'required|exists:parties,id', // party_id exists in the parties table
            'election_id' => 'required|exists:elections,id', // election_id exists in the elections table
            'created_at' => 'required|date',
        ]);
        
        // Handle file upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }
        
        // Create the candidate
        Candidate::create($validatedData);
        
        return redirect()->route('candidates.index')->with('success', 'New candidate added successfully.');
    }
}
