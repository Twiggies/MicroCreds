<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EducatorController extends Controller
{
    public function index() {
        return view('dashboard');
    }
}
