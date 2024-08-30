<?php

namespace App\Http\Controllers;

use App\Models\Megye;
use Illuminate\View\View;

class MegyeController extends Controller
{
    public function index(): View
    {
        $megyek = Megye::all();
        return view('home', ['megyek' => $megyek]);
    }
}
