<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewClassController extends Controller
{
    public function index()
    {
        $classes = DB::table('classes as c1')
        ->join('subjects', 'subjects.class_id', '=', 'c1.id')
        ->join('users as u1', 'u1.class_id', '=', 'c1.id')
        ->select('u1.name as student_name', 'c1.name as class_name', 'subjects.name as subject_name')
        ->get();

        return view('student.view-class.index', ['classes' => $classes]);
    }
}