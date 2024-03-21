<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTranslation;

class DashboardController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['currentActive'] = 'dashboard';
    }
    public function index()
    {
        return view('dashboard', $this->data);
    }
}