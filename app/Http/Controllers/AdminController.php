<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Render admin view
    public function index() {
        return view('admin.index');
    }
}
