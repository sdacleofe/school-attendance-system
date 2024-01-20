<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {        
        $classes = DB::table('classes')->get();

        $students = User::join('role_user', 'users.id', '=', 'role_user.user_id')
        ->where('role_user.role_id', '3')
        ->paginate(6);

        return view('admin.students.index', ['students' => $students, 'classes' => $classes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'parent_phone' => 'required|numeric|digits:11',
            'role_id' => 'required|exists:roles,id',
            'class_id' => 'nullable|exists:classes,id',
        ]);

        $students = new User;
        $students->name = $request->name;
        $students->email = $request->email;
        $students->phone = $request->parent_phone;
        $students->password = Hash::make($request->password);
        $students->class_id = $request->class_id;
        $students->save();

        $students->addRole('student');

        return redirect()->route('admin.students.index');
    }

    public function destroy(User $student)
    {
        DB::transaction(function () use ($student) {
            $student->roles()->detach();
            $student->delete();
        });
    
        return redirect()->route('admin.students.index');
    }
}
