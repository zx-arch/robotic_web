<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdmin extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data['currentAdminMenu'] = 'dashboard';
    }
    public function index()
    {
        return view('admin.dashboard', $this->data);
    }
}