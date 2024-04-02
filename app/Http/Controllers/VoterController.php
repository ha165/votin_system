<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class VoterController extends Controller
{
    public function create()
{
    return view('admin.pages.voters.create');
}
    public function index()
    {
        $voters = User::where('role','voter')->get();
        return view('admin.pages.voters.voters',compact('voters'));
    }
    public function edit(User $voter)
{
    return view('admin.pages.voters.edit', compact('voter'));
}
public function update(Request $request, User $voter)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|string|max:255|unique:users,student_id',
        'course' => 'required|string|max:255',     
    ]);

    $voter->update($request->all());

    return redirect()->route('voters')->with('success', 'Voter updated successfully.');
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|string|max:255|unique:users,student_id',
        'email'=>'required|email',
        'course' => 'required|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    User::create($request->all());

    return redirect()->route('voters')->with('success', 'New voter added successfully.');
}
public function destroy(User $voter)
{
    $voter->delete();

    return redirect()->route('voters')->with('success', 'Voter deleted successfully.');
}
public function getVoterDistributionByCourse()
{
    // Query the database to get the count of voters in each course
    $voterDistribution = User::select('course', DB::raw('count(*) as total'))
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
