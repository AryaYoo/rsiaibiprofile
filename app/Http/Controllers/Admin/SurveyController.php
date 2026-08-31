<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource (placeholder).
     */
    public function index()
    {
        return view('admin.surveys.index');
    }
}
