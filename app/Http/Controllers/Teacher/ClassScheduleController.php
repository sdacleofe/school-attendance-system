<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Classes;
use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClassScheduleController extends Controller
{
    public function index() {

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

        return view('teacher.class-schedule.index', [
            'classes' => $classes,
            'subjects' => $subjects,
            'schedules' => $schedules,
        ]);
    } 
    
    public function store(Request $request)
    {

        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $classSchedule = new ClassSchedule;
        $classSchedule->class_id = $request->class_id;
        $classSchedule->subject_id = $request->subject_id;
        $classSchedule->date = $request->date;
        $classSchedule->start_time = $request->start_time;
        $classSchedule->end_time = $request->end_time;
        $classSchedule->teacher_id = Auth::id();
        $classSchedule->save();

        return redirect()->route('teacher.class-schedule.index');
    }

    public function destroy(ClassSchedule $classSchedule)
    {
        $classSchedule->delete();

        return redirect()->route('teacher.class-schedule.index');
    }
}
