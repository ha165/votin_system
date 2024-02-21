<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\voter;
use Illuminate\Support\Facades\DB;
class VoterController extends Controller
{
    public function create()
{
    return view('pages.voters.create');
}
    public function index()
    {
        $voters = Voter::all();
        return view('pages.voters.voters',compact('voters'));
    }
    public function edit(Voter $voter)
{
    return view('pages.voters.edit', compact('voter'));
}
public function update(Request $request, Voter $voter)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'student_id' => 'required|string|max:255|unique:voters,student_id,' . $voter->id,
        'course' => 'required|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    $voter->update($request->all());

    return redirect()->route('voters')->with('success', 'Voter updated successfully.');
}
public function store(Request $request)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'Student_id' => 'required|string|max:255|unique:voters,Student_id',
        'course' => 'required|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    Voter::create($request->all());

    return redirect()->route('voters')->with('success', 'New voter added successfully.');
}
public function destroy(Voter $voter)
{
    $voter->delete();

    return redirect()->route('voters')->with('success', 'Voter deleted successfully.');
}
public function getVoterDistributionByCourse()
{
    // Query the database to get the count of voters in each course
    $voterDistribution = Voter::select('course', DB::raw('count(*) as total'))
                              ->groupBy('course')
                              ->get();

    // Extract course names and total counts from the query result
    $courses = $voterDistribution->pluck('course');
    $totals = $voterDistribution->pluck('total');

    // Return the course names and total counts as JSON response
    return response()->json([
        'courses' => $courses,
        'totals' => $totals,
    ]);
}
}
