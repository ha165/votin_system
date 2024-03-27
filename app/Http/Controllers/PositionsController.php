<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use App\Models\Position;
use App\Models\Election;

class PositionsController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        if (auth()->user()->role == 'admin') {
            return view('admin.pages.positions.position', compact('positions'));
        } else {
            return view('voters.positions.position', compact('positions'));
        }

    }
    public function create()
    {
        $elections = Election::all();
        return view('admin.pages.positions.create', compact('elections'));
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
        $elections = Election::all();
        return view('admin.pages.positions.edit', compact('positions', 'elections'));
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
    public function destroy(Position $positions)
    {
        try {
            $positions->delete();
            return redirect()->route('parties')->with('success', 'Party removed successfully.');

        } catch (QueryException $e) {
            $errorMessage = $e->getMessage();
            if (Str::contains($errorMessage, 'Integrity constraint violation')) {
                return redirect()->route('positions')->with('error', 'An integrity constraint violation occurred. This party cannot be deleted because it is associated with other records.');
            } else {
                // Handle other database-related errors if needed
                return redirect()->route('positions')->with('error', 'An error occurred while deleting the party.');
            }
        }
    }
}
