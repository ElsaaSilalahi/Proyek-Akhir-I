<?php

namespace App\Http\Controllers\Web;

use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $informations = Information::all();
        return view('pages.web.informations.main', compact('informations'));
    }

    public function show(Information $information)
    {
        return view('pages.web.informations.show', compact('information'));
    }
}
