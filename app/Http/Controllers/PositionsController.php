<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Election;

class PositionsController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('pages.positions.position',compact('positions'));
    }
    public function create()
    {
        $elections = Election::all();
        return view('pages.positions.create',compact('elections'));
    }
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'election_id' => 'required|exists:elections,id',
    ]);

    Position::create($request->all());

    return redirect()->route('positions')->with('success', 'New  Position added successfully.');
    }
    public function edit(Position $positions)
     {
        $elections =Election::all();
       return view('pages.positions.edit', compact('positions','elections'));
     }  
    public function update(Request $request, Position $positions)
    {
    $request->validate
       ([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'election_id' => 'required|exists:elections,id',
        ]);

       $positions->update($request->all());

       return redirect()->route('positions')->with('success', 'Positions updated successfully.');
    } 
}
