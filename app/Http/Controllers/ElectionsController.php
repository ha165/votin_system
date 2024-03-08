<?php

namespace App\Http\Controllers;
use App\Models\Election;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ElectionsController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return view('pages.elections.elections')->with('elections', $elections);
    }  
    public function create()
    {
        return view('pages.elections.new');
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|string|max:255|valid_enum',
        'description' => 'required|string|max:255',
        'start' => 'required|date',
        'end' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($request) {
                $start = Carbon::parse($request->start);
                $end = Carbon::parse($value);

                if ($start->isToday() && $end->lessThan(Carbon::today())) {
                    $fail("The end date cannot be less than today when the start date is today.");
                }
            },
        ],
    ]);

    Election::create($request->all());
    
    return redirect()->route('elections')->with('success', 'New Election added successfully.');
}
        public function edit(Election $elections )
         {
            return view('pages.elections.edit', compact('elections'));
         }
        public function update(Request $request, Election $elections)
         {
           $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string|max:255|valid_enum',
            'description' => 'required|string|max:255',
            'start' => 'required|date',
            'end'=>'required|date'
           ]);

          $elections->update($request->all());
  
          return redirect()->route('elections')->with('success', 'Election updated successfully.');
        }
        public function destroy(Election $elections)
        {
          $elections->delete();

          return redirect()->route('elections')->with('success', 'Election deleted successfully.');
        }

}