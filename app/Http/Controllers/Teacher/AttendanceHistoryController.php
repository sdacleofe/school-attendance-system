<?php

namespace App\Http\Controllers\Teacher;

use App\Models\ClassSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AttendanceHistoryController extends Controller
{
    public function index() {
        $attendances = DB::table('attendances')->get();
    
        return view('teacher.attendance-history.index', ['attendances' => $attendances]);
    } 
}