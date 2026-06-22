<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with([
            'grade',
            'academicYear',
            'homeroomTeacher'
        ])->orderBy('academic_year_id', 'desc')->paginate(10);

        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        $academicYears = AcademicYear::orderByDesc('year')->get();
        $grades = Grade::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.classrooms.create', compact(
            'academicYears',
            'grades',
            'teachers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'academic_year_id'     => 'required|exists:academic_years,id',
            'grade_id'             => 'required|exists:grades,id',
            'homeroom_teacher_id'  => 'required|exists:teachers,id',
            'name'                 => 'required',
        ]);

        Classroom::create($request->only([
            'academic_year_id',
            'grade_id',
            'homeroom_teacher_id',
            'name',
        ]));

        return redirect()
            ->route('admin.classrooms.index')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Classroom $classroom)
    {
        $academicYears = AcademicYear::orderByDesc('year')->get();
        $grades = Grade::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.classrooms.edit', compact(
            'classroom',
            'academicYears',
            'grades',
            'teachers'
        ));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'academic_year_id'     => 'required|exists:academic_years,id',
            'grade_id'             => 'required|exists:grades,id',
            'homeroom_teacher_id'  => 'required|exists:teachers,id',
            'name'                 => 'required',
        ]);

        $classroom->update($request->only([
            'academic_year_id',
            'grade_id',
            'homeroom_teacher_id',
            'name',
        ]));

        return redirect()
            ->route('admin.classrooms.index')
            ->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(Classroom $classroom)
    {
        if (
            $classroom->classAssignments()->exists() ||
            $classroom->schedules()->exists()
        ) {
            return back()->with('error', 'Kelas masih memiliki data akademik');
        }

        $classroom->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}
