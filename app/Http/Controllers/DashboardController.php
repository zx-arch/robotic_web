<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTranslation;

class DashboardController extends Controller
{
    public function index()
    {
        return view('partial.dashboard');
    }
}