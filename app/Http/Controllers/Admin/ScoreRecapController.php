<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreRecapController extends Controller
{
    public function index(Classroom $classroom, Request $request)
    {
        $activeYear = null;

        if ($request->filled('academic_year_id')) {
            $activeYear = AcademicYear::where('id', $request->academic_year_id)->firstOrFail();
        } else {
            $activeYear = AcademicYear::where('is_active', true)->firstOrFail();
        }
        
        $academicYears = AcademicYear::all();

        $classrooms = Classroom::where('academic_year_id', $activeYear->id)
            ->orderBy('name')
            ->get();

        return view('admin.scores.recap.index', compact(
            'classrooms',
            'activeYear',
            'academicYears'
        ));
    }

    public function show(Classroom $classroom, Request $request)
    {
        $semester = $request->get('semester', 'ganjil');

        $academicYear = $request->filled('academic_year_id')
            ? AcademicYear::findOrFail($request->academic_year_id)
            : AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $academicYear->id, 404);


        // mapel + guru di kelas ini
        $schedules = Schedule::with(['subject', 'teacher'])
            ->where('classroom_id', $classroom->id)
            ->get();

        $studentCount = $classroom->students()->count();

        $scoreTypes = ['tugas', 'uts', 'uas'];

        $recaps = $schedules->map(function ($schedule) use (
            $classroom,
            $semester,
            $studentCount,
            $scoreTypes
        ) {
            $statuses = [];

            foreach ($scoreTypes as $type) {
                $count = Score::where([
                        'classroom_id' => $classroom->id,
                        'subject_id'   => $schedule->subject_id,
                        'semester'     => $semester,
                        'type'         => $type,
                    ])
                    ->distinct('student_id')
                    ->count('student_id');

                $statuses[$type] = ($count === $studentCount);
            }

            return [
                'subject'  => $schedule->subject,
                'teacher'  => $schedule->teacher,
                'statuses' => $statuses,
            ];
        });

        return view('admin.scores.recap.show', compact(
            'classroom',
            'academicYear',
            'semester',
            'recaps'
        ));
    }

    public function detail(Classroom $classroom, $subjectId, Request $request)
    {
        $semester = $request->get('semester', 'ganjil');
        
        // return response()->json($semester);
        $students = $classroom->students()
            ->with(['scores' => function ($q) use ($subjectId, $semester) {
                $q->where('subject_id', $subjectId)
                  ->where('semester', $semester);
            }])
            ->orderBy('name')
            ->get();

        return view('admin.scores.recap.detail', compact(
            'classroom',
            'students',
            'semester'
        ));
    }
}
