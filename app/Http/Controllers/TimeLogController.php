<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use Illuminate\Http\Request;

class TimeLogController extends Controller
{
    public function index()
    {
        $timeLogs = TimeLog::all();
        return view('time_logs.index', compact('timeLogs'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }
}

