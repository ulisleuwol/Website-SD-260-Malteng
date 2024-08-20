<?php

namespace App\Http\Controllers\Guest;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $agenda = Agenda::with('user')
                        ->latest()
                        ->search($request->search)
                        ->paginate(9)
                        ->withQueryString();
        return view('guest.agenda.agenda', compact('agenda'));
    }
}
