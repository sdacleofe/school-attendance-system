<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request) {
        $search = $request->get('search');
    
        $query = DB::table('users')
            ->join('classes', 'users.class_id', '=', 'classes.id')
            ->join('subjects', 'classes.id', '=', 'subjects.class_id')
            ->where('classes.teacher_id', Auth::id());
    
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%')
                    ->orWhere('users.phone', 'like', '%' . $search . '%');
            });
        }
    
        $students = $query->select('users.id', 'users.name', 'users.email', 'users.phone', 'classes.name as class_name', 'subjects.name as subject_name')
            ->paginate(10); 
    
        return view('teacher.students.index', [ 'students' => $students ]);
    }
}
