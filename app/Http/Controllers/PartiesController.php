<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use App\Models\Party;
use App\Models\Election;

class PartiesController extends Controller
{
    public function index ()
    {
        $parties = Party::all();
        if(auth()->user()->role== 'admin'){
           return view('admin.pages.parties.party',compact('parties'));
        }else{
            return view('voters.parties.party',compact('parties'));
        }
        
    }
    public function create()
    {
        $elections = Election::all();
        return view('admin.pages.parties.create',compact('elections'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:700',
            'election_id' => 'required|exists:elections,id',
            'created_at'=> 'required|date'
        ]);

         if ($request->hasFile('logo')) {
            $photoPath = $request->file('logo')->store('photos', 'public');
            $validatedData['logo'] = $photoPath;
        }
        Party::create($validatedData);
        
        return redirect()->route('parties')->with('success', 'Party added successfully.');
    }
    public function edit(Party $parties)
    {
        $elections = Election::all();
        return view('admin.pages.parties.edit',compact('parties','elections'));
    }
    public function update(Request $request, Party $parties)
{
    $validatedData = $request->validate([
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'election_id' => 'required|exists:elections,id',
    ]);
    
    if ($request->hasFile('logo')) {
        $photoPath = $request->file('logo')->store('photos', 'public');
        $validatedData['logo'] = $photoPath;
    }

    $parties->update($validatedData);

    return redirect()->route('parties')->with('success', 'Party updated successfully.');
}
public function destroy(Party $parties)
{
    try {
        $parties->delete();
        return redirect()->route('parties')->with('success', 'Party removed successfully.');
    } catch (QueryException $e) {
        $errorMessage = $e->getMessage();
        if (Str::contains($errorMessage, 'Integrity constraint violation')) {
            return redirect()->back()->with('error', 'An integrity constraint violation occurred. This party cannot be deleted because it is associated with other records.');
        } else {
            // Handle other database-related errors if needed
            return redirect()->back()->with('error', 'An error occurred while deleting the party.');
        }
    }
}

}