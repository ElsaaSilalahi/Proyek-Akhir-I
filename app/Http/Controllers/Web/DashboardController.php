<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::all();
        return view('pages.web.dashboard.main', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('pages.web.dashboard.show', compact('ticket'));
    }
}
