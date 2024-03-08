<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\voter;
use App\Models\Candidate;
use App\Models\Party;

class DashboardController extends Controller
{
    public function index()
    {
        $voters = voter::all();
        $candidates = Candidate::all();
        $parties = Party::all();
        $allparties = $parties->count();
        $allcandidates = $candidates->count();
       $voterCount = $voters->count();
        return view('admin.pages.index',compact('voterCount','allcandidates','allparties'));
    }
}
