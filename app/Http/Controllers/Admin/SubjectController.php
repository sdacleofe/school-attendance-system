<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function index()
    {
        $classes = DB::table('classes')->get();

        $subjects = DB::table('subjects')
        ->join('classes', 'subjects.class_id', '=', 'classes.id')
        ->select('subjects.*', 'classes.name as class_name')
        ->get();

        return view('admin.subjects.index' , ['classes' => $classes, 'subjects' => $subjects]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        // Create a new user
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->class_id = $request->class_id;
        
        $subject->save();

        // Redirect to the users index (or wherever you want)
        return redirect()->route('admin.subjects.index');
    }
}
