<?php

namespace App\Http\Controllers\Guest;

use App\Models\PPDB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PPDBController extends Controller
{

    public function index()
    {
        $ppdb = PPDB::with('user')->get();
    
        return view('guest.ppdb.ppdb', compact('ppdb'));
    }
}
