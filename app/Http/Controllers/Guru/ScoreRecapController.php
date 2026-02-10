<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScoreRecapController extends Controller
{
    public function index(Classroom $classroom, $subjectId, Request $request)
    {
        $teacherId = auth()->user()->teacher->id;

        $semester = $request->get('semester', 'ganjil');

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        // validasi kelas tahun aktif
        abort_if(
            $classroom->academic_year_id !== $activeYear->id,
            404
        );

        // validasi guru mengajar mapel tsb
        $schedule = Schedule::with('subject')
            ->where('teacher_id', $teacherId)
            ->where('classroom_id', $classroom->id)
            ->where('subject_id', $subjectId)
            ->firstOrFail();

        // ambil siswa dari registrasi kelas
        $students = $classroom->students()
            ->with(['scores' => function ($q) use ($subjectId, $semester) {
                $q->where('subject_id', $subjectId)
                  ->where('semester', $semester);
            }])
            ->orderBy('name')
            ->get();

        return view('guru.scores.recap', compact(
            'classroom',
            'schedule',
            'students',
            'semester',
            'activeYear'
        ));
    }
}
