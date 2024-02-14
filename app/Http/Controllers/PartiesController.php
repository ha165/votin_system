<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartiesController extends Controller
{
    public function index ()
    {
        $parties = Party::all();
        return view('pages.parties.index',compact('$parties'));
    }
}
