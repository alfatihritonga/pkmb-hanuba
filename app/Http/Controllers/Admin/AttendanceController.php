<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $activeYear = $request->filled('academic_year_id')
            ? AcademicYear::findOrFail($request->academic_year_id)
            : AcademicYear::where('is_active', true)->firstOrFail();

        $academicYears = AcademicYear::all();

        $classrooms = Classroom::with('grade')
            ->where('academic_year_id', $activeYear->id)
            ->orderBy('name')
            ->get();

        return view('admin.attendances.index', compact(
            'classrooms',
            'activeYear',
            'academicYears'
        ));
    }

    public function show(Classroom $classroom, Request $request)
    {
        $academicYear = $request->filled('academic_year_id')
            ? AcademicYear::findOrFail($request->academic_year_id)
            : AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $academicYear->id, 404);

        $schedules = Schedule::with(['subject', 'teacher'])
            ->where('classroom_id', $classroom->id)
            ->get();

        $dates = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->select(
                'schedule_id',
                'date',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN validated_at IS NOT NULL THEN 1 ELSE 0 END) as validated_count')
            )
            ->groupBy('schedule_id', 'date')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('schedule_id')
            ->map(function ($items) {
                return $items->map(function ($item) {
                    $item->is_validated = ((int) $item->total > 0)
                        && ((int) $item->total === (int) $item->validated_count);

                    return $item;
                });
            });

        return view('admin.attendances.show', compact(
            'classroom',
            'academicYear',
            'schedules',
            'dates'
        ));
    }

    public function detail(Classroom $classroom, Schedule $schedule, $date, Request $request)
    {
        $academicYear = $request->filled('academic_year_id')
            ? AcademicYear::findOrFail($request->academic_year_id)
            : AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $academicYear->id, 404);
        abort_if($schedule->classroom_id !== $classroom->id, 404);

        $students = $classroom->students()
            ->with(['attendances' => function ($q) use ($schedule, $date) {
                $q->where('schedule_id', $schedule->id)
                    ->where('date', $date);
            }])
            ->orderBy('name')
            ->get();

        $attendances = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->where('schedule_id', $schedule->id)
            ->where('date', $date)
            ->get();

        $isValidated = $attendances->isNotEmpty()
            && $attendances->every(fn ($attendance) => $attendance->validated_at !== null);

        return view('admin.attendances.detail', compact(
            'classroom',
            'schedule',
            'date',
            'students',
            'isValidated',
            'academicYear'
        ));
    }

    public function validateAttendance(Classroom $classroom, Schedule $schedule, $date, Request $request)
    {
        $academicYear = $request->filled('academic_year_id')
            ? AcademicYear::findOrFail($request->academic_year_id)
            : AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $academicYear->id, 404);
        abort_if($schedule->classroom_id !== $classroom->id, 404);

        $updated = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->where('schedule_id', $schedule->id)
            ->where('date', $date)
            ->update([
                'validated_at' => now(),
                'validated_by' => auth()->id(),
            ]);

        abort_if($updated === 0, 404);

        return back()->with('success', 'Absensi berhasil divalidasi.');
    }

    public function revokeValidation(Classroom $classroom, Schedule $schedule, $date, Request $request)
    {
        $academicYear = $request->filled('academic_year_id')
            ? AcademicYear::findOrFail($request->academic_year_id)
            : AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $academicYear->id, 404);
        abort_if($schedule->classroom_id !== $classroom->id, 404);

        $updated = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->where('schedule_id', $schedule->id)
            ->where('date', $date)
            ->update([
                'validated_at' => null,
                'validated_by' => null,
            ]);

        abort_if($updated === 0, 404);

        return back()->with('success', 'Validasi absensi dibatalkan.');
    }
}
