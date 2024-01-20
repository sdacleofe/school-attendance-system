<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::join('role_user', 'users.id', '=', 'role_user.user_id')
        ->where('role_user.role_id', '2')
        ->paginate(6);

        return view('admin.teachers.index' , ['teachers' => $teachers]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'parent_phone' => 'nullable|numeric|digits:11',
            'role_id' => 'required|exists:roles,id',
        ]);

        $teacher = new User;
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->save();

        $teacher->addRole('teacher');

        return redirect()->route('admin.teachers.index');
    }

    public function destroy(User $teacher)
    {
        DB::transaction(function () use ($teacher) {
            $teacher->roles()->detach();
            $teacher->delete();
        });
    
        return redirect()->route('admin.teachers.index');
    }
}
