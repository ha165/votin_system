<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\Party;
use Illuminate\Http\Request;
use TCPDF;
use Illuminate\Support\Facades\Http;

class CandidatesController extends Controller
{
    public function index()
    {
        $positions = Position::paginate(8);
        $candidates = Candidate::paginate(8);
        $parties = Party::paginate(8);
        if(Auth()->user()->role == 'admin'){
             return view('admin.pages.candidates.index', compact('candidates', 'positions'));
        }else{
            return view('voters.candidates.index', compact('candidates', 'positions','parties'));
        }
      
    }
    public function create()
    {
        $elections = Election::all();
        $parties = Party::all();
        $positions = Position::all();
        return view('admin.pages.candidates.add', compact('elections', 'parties', 'positions'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'manifesto' => 'required|string|max:255',
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
    public function edit(Candidate $candidate)
    {
        $positions = Position::all();
        $parties = Party::all();
        $elections = Election::all();
        return view('admin.pages.candidates.edit', compact('candidate', 'positions', 'parties', 'elections'));
    }
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id', //  position_id exists in the positions table
            'party_id' => 'required|exists:parties,id', // party_id exists in the parties table
            'election_id' => 'required|exists:elections,id', // election_id exists in the elections table
        ]);
        $candidate->update($request->all());

        return redirect()->route('candidates')->with('success', 'Candidate updated successfully.');
    }
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return redirect()->route('candidates')->with('success', 'Candidate deleted successfully.');
    }
    public function generatePDF()
    {
        $positions = Position::all();
        $candidates = Candidate::all();

        $pdf = new TCPDF();
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(30, 10, 'Photo', 1, 0, 'C');
        $pdf->Cell(30, 10, 'ID', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Name', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Course', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Student ID', 1, 0, 'C');
        $pdf->Ln();
        // Loop through candidates data
        foreach ($candidates as $candidate) {

            // Embed photo if available
            if ($candidate->photo && file_exists(public_path('storage/' . $candidate->photo))) {
                // Get the full file path
                $imagePath = public_path('storage/' . $candidate->photo);
                // Embed the image into the PDF
                $pdf->Image($imagePath, $pdf->GetX(), $pdf->GetY(), 30, 20, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
            } else {
                // Handle missing image or invalid file path
                $pdf->Cell(30, 10, 'No Image', 1, 0, 'C');
            }

            // Add other candidate data
            $pdf->Cell(30, 10, $candidate->id, 1, 0, 'C');
            $pdf->Cell(50, 10, $candidate->name, 1, 0, 'C');
            $pdf->Cell(50, 10, $candidate->course, 1, 0, 'C');
            $pdf->Cell(50, 10, $candidate->student_id, 1, 0, 'C');
            $pdf->Ln();
            // Add more cells for other candidate data as needed
        }

        // Output PDF as download
        $pdf->Output('candidates.pdf', 'D');
    }
}