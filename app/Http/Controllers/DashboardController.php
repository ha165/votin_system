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
        if (auth()->user()->role == 'admin') {
            $candidates = Candidate::all();
            $parties = Party::all();
            $allparties = $parties->count();
            $allcandidates = $candidates->count();
            return view('admin.pages.index', compact('allcandidates', 'allparties'));
        }elseif(auth()->user()->role == 'voter'){
            return view('voters.index');
        }else{
            return redirect()->route('login');
        }

    }
}
