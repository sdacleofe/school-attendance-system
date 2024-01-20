<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TakeAttendanceController extends Controller
{
    public function index() {
        $userId = Auth::id();
    
        $qrCode = QrCode::size(200)->generate($userId);

        $classes = DB::table('classes')
        ->join('subjects', 'classes.id', '=', 'subjects.class_id')
        ->where('classes.teacher_id', Auth::id())
        ->select('classes.id', 'classes.name as class_name', 'subjects.name as subject_name')
        ->get();

        $subjects = DB::table('subjects')->get();

        $schedules = DB::table('class_schedules')
            ->join('classes', 'class_schedules.class_id', '=', 'classes.id')
            ->join('subjects', 'class_schedules.subject_id', '=', 'subjects.id')
            ->where('class_schedules.teacher_id', Auth::id())
            ->select('class_schedules.id', 'class_schedules.date', 'class_schedules.start_time', 'class_schedules.end_time', 'classes.name as class_name', 'subjects.name as subject_name')
            ->get();

        return view('teacher.take-attendance.index', ['qrCode' => $qrCode, 'userId' => $userId, 'classes' => $classes, 'subjects' => $subjects, 'schedules' => $schedules ]);
    }

    public function store(Request $request)
    {

        

        return redirect()->route('teacher.take-attendance.index');
    }

}
