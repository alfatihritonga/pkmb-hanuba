<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Score;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    public function create(Classroom $classroom, $subjectId)
    {
        $teacherId = auth()->user()->teacher->id;

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        // pastikan kelas tahun aktif
        abort_if(
            $classroom->academic_year_id !== $activeYear->id,
            404
        );

        // pastikan guru mengajar mapel tsb di kelas ini
        $schedule = Schedule::with('subject')
            ->where('teacher_id', $teacherId)
            ->where('classroom_id', $classroom->id)
            ->where('subject_id', $subjectId)
            ->firstOrFail();

        // ambil siswa dari registrasi kelas
        $students = $classroom->students()
            ->orderBy('name')
            ->get();

        return view('guru.scores.create', compact(
            'classroom',
            'schedule',
            'students',
            'activeYear'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id'   => 'required|exists:subjects,id',
            'semester'     => 'required|in:ganjil,genap',
            'type'         => 'required|in:tugas,uts,uas',
            'scores'       => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->scores as $studentId => $value) {
                if ($value === null || $value === '') {
                    continue;
                }

                Score::updateOrCreate(
                    [
                        'student_id'   => $studentId,
                        'classroom_id' => $request->classroom_id,
                        'subject_id'   => $request->subject_id,
                        'semester'     => $request->semester,
                        'type'         => $request->type,
                    ],
                    [
                        'score' => $value,
                    ]
                );
            }
        });

        return back()->with('success', 'Nilai berhasil disimpan.');
    }
}
