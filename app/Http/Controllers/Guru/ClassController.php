<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $teacherId = auth()->user()->teacher->id;

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        $classes = Schedule::with([
                'classroom.grade',
                'classroom.academicYear',
                'subject',
            ])
            ->where('teacher_id', $teacherId)
            ->whereHas('classroom', function ($q) use ($activeYear) {
                $q->where('academic_year_id', $activeYear->id);
            })
            ->get()
            ->groupBy('classroom_id');

        return view('guru.classes.index', compact(
            'classes',
            'activeYear'
        ));
    }

    public function show(Classroom $classroom)
    {
        $teacherId = auth()->user()->teacher->id;

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        // Pastikan kelas ini milik tahun aktif
        abort_if(
            $classroom->academic_year_id !== $activeYear->id,
            404
        );

        // Pastikan guru benar-benar mengajar di kelas ini
        $schedules = Schedule::with('subject')
            ->where('teacher_id', $teacherId)
            ->where('classroom_id', $classroom->id)
            ->get();

        abort_if($schedules->isEmpty(), 403);

        // Ambil siswa dari registrasi kelas
        $students = $classroom->students()
            ->orderBy('name')
            ->get();

        return view('guru.classes.show', compact(
            'classroom',
            'activeYear',
            'schedules',
            'students'
        ));
    }
}
