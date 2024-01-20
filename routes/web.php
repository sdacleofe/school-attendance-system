<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Teacher\IndexController as TeacherIndexController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Teacher\AttendanceHistoryController;
use App\Http\Controllers\Teacher\ClassScheduleController;
use App\Http\Controllers\Teacher\TakeAttendanceController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Student\IndexController as StudentIndexController;
use App\Http\Controllers\Student\AttendanceHistoryController as StudentAttendanceHistoryController;
use App\Http\Controllers\Student\TakeAttendanceController as StudentTakeAttendanceController;
use App\Http\Controllers\Student\ViewClassController as StudentViewClassController; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminIndexController::class, 'index'])->name('index');
    Route::resource('/teachers', TeacherController::class);
    Route::resource('/students', AdminStudentController::class);
    Route::resource('/classes', ClassController::class);
    Route::resource('/subjects', SubjectController::class);

    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::post('/students', [AdminStudentController::class, 'store'])->name('students.store');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');

    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    Route::delete('/students/{student}', [AdminStudentController::class, 'destroy'])->name('students.destroy');
    Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
});

Route::middleware(['auth', 'role:teacher'])->name('teacher.')->prefix('teacher')->group(function () {
    Route::get('/', [TeacherIndexController::class, 'index'])->name('index');
    Route::resource('/students', TeacherStudentController::class);
    Route::resource('/attendance-history', AttendanceHistoryController::class);
    Route::resource('/class-schedule', ClassScheduleController::class);
    Route::resource('/take-attendance', TakeAttendanceController::class);

    Route::post('/class-schedule', [ClassScheduleController::class, 'store'])->name('class-schedule.store');

    Route::delete('/students/{student}', [TeacherStudentController::class, 'destroy'])->name('students.destroy');
    Route::delete('/class-schedule/{class_schedule}', [ClassScheduleController::class, 'destroy'])->name('class-schedule.destroy');

});

Route::middleware(['auth', 'role:student'])->name('student.')->prefix('student')->group(function () {
    Route::get('/', [StudentIndexController::class, 'index'])->name('index');
    Route::resource('/attendance-history', StudentAttendanceHistoryController::class);
    Route::resource('/take-attendance', StudentTakeAttendanceController::class);
    Route::resource('/view-class', StudentViewClassController::class);

    Route::post('/take-attendance', [StudentTakeAttendanceController::class, 'store'])->name('take-attendance.store');
    Route::post('/view-class', [StudentViewClassController::class, 'store'])->name('view-class.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
