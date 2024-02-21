<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartiesController extends Controller
{
    public function index ()
    {
        $parties = Party::all();
        return view('pages.parties.party',compact('parties'));
    }
    public function create()
    {
        return view('pages.parties.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'created_at'=> 'required|daate'
        ]);

         if ($request->hasFile('logo')) {
            $photoPath = $request->file('logo')->store('photos', 'public');
            $validatedData['logo'] = $photoPath;
        }
        Party::create($validatedData);
        
        return redirect()->route('parties')->with('success', 'Party added successfully.');
    }
}
