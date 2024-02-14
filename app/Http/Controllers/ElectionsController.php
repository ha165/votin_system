<?php

namespace App\Http\Controllers;
use App\Models\Election;

use Illuminate\Http\Request;

class ElectionsController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return view('pages.elections.election')->with('elections', $elections);
}
}