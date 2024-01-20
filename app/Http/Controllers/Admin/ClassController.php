<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function index()
    {
        $teachers = DB::table('users')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where('roles.name', 'teacher')
        ->select('users.*')
        ->get();

        $classes = DB::table('classes')->get();

        $lists = DB::table('classes')
        ->join('users', 'classes.teacher_id', '=', 'users.id')
        ->select('classes.*', 'users.name as teacher_name')
        ->get();
    
        return view('admin.classes.index' , ['teachers' => $teachers, 'classes' => $classes, 'lists' => $lists]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $class = new Classes;
        $class->name = $request->name;
        $class->teacher_id = $request->teacher_id;
        $class->save();

        return redirect()->route('admin.classes.index');
    }

    public function destroy($id)
    {
        $class = Classes::find($id);

        if ($class) {
            $class->delete();
            return redirect()->route('admin.classes.index');
        }
    
        return redirect()->route('admin.classes.index');
    }
}
