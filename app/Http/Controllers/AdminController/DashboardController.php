<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function dashboard(Request $request)
    {
        return view('adminView.dashboard');
    }
}
