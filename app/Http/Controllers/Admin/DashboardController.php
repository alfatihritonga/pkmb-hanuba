<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\ClassAssignment;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {
        $activeYear = AcademicYear::where('is_active', true)->first();

        $totalClasses = Classroom::count();
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();

        $registeredStudents = ClassAssignment::count();

        // kelas tanpa siswa
        $classesWithoutStudents = Classroom::doesntHave('classAssignments')->count();

        // kelas tanpa jadwal
        $classesWithoutSchedules = Classroom::doesntHave('schedules')->count();

        return view('admin.dashboard', compact(
            'activeYear',
            'totalClasses',
            'totalStudents',
            'totalTeachers',
            'registeredStudents',
            'classesWithoutStudents',
            'classesWithoutSchedules'
        ));
    }
}
