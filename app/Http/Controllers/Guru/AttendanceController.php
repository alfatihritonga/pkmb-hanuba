<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(Classroom $classroom, Schedule $schedule, Request $request)
    {
        $teacherId = auth()->user()->teacher->id;

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $activeYear->id, 404);

        $schedule = $this->validateSchedule($classroom, $schedule, $teacherId);

        $dates = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->where('schedule_id', $schedule->id)
            ->select(
                'date',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN validated_at IS NOT NULL THEN 1 ELSE 0 END) as validated_count')
            )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($item) {
                $item->is_validated = ((int) $item->total > 0)
                    && ((int) $item->total === (int) $item->validated_count);

                return $item;
            });

        return view('guru.attendances.index', compact(
            'classroom',
            'schedule',
            'activeYear',
            'dates'
        ));
    }

    public function create(Classroom $classroom, Schedule $schedule, Request $request)
    {
        $teacherId = auth()->user()->teacher->id;

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $activeYear->id, 404);

        $schedule = $this->validateSchedule($classroom, $schedule, $teacherId);

        $date = $request->get('date', now()->toDateString());

        $students = $classroom->students()
            ->orderBy('name')
            ->get();

        $attendances = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->where('schedule_id', $schedule->id)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id');

        $isValidated = $attendances->isNotEmpty()
            && $attendances->every(fn ($attendance) => $attendance->validated_at !== null);

        $formAction = route('guru.attendances.store', [$classroom, $schedule]);
        $isEdit = false;

        return view('guru.attendances.create', compact(
            'classroom',
            'schedule',
            'activeYear',
            'date',
            'students',
            'attendances',
            'isValidated',
            'formAction',
            'isEdit'
        ));
    }

    public function store(Classroom $classroom, Schedule $schedule, Request $request)
    {
        $teacherId = auth()->user()->teacher->id;

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $activeYear->id, 404);

        $schedule = $this->validateSchedule($classroom, $schedule, $teacherId);

        $data = $request->validate([
            'date' => 'required|date',
            'statuses' => 'required|array',
            'statuses.*' => 'required|in:hadir,izin,sakit,alpha',
            'notes' => 'nullable|array',
            'notes.*' => 'nullable|string|max:255',
        ]);

        $totalCount = Attendance::where('classroom_id', $classroom->id)
            ->where('schedule_id', $schedule->id)
            ->where('date', $data['date'])
            ->count();

        if ($totalCount > 0) {
            $validatedCount = Attendance::where('classroom_id', $classroom->id)
                ->where('schedule_id', $schedule->id)
                ->where('date', $data['date'])
                ->whereNotNull('validated_at')
                ->count();

            abort_if($validatedCount === $totalCount, 403);
        }

        DB::transaction(function () use ($data, $classroom, $schedule) {
            foreach ($data['statuses'] as $studentId => $status) {
                Attendance::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'classroom_id' => $classroom->id,
                        'schedule_id' => $schedule->id,
                        'date' => $data['date'],
                    ],
                    [
                        'status' => $status,
                        'notes' => $data['notes'][$studentId] ?? null,
                    ]
                );
            }
        });

        return redirect()
            ->route('guru.attendances.index', [$classroom, $schedule])
            ->with('success', 'Absensi berhasil disimpan.');
    }

    public function edit(Classroom $classroom, Schedule $schedule, $date)
    {
        $teacherId = auth()->user()->teacher->id;

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        abort_if($classroom->academic_year_id !== $activeYear->id, 404);

        $schedule = $this->validateSchedule($classroom, $schedule, $teacherId);

        $attendances = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->where('schedule_id', $schedule->id)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id');

        abort_if($attendances->isEmpty(), 404);
        abort_if($attendances->first()->validated_at !== null, 403);

        $students = $classroom->students()
            ->orderBy('name')
            ->get();

        $isValidated = false;

        $formAction = route('guru.attendances.update', [$classroom, $schedule, $date]);
        $isEdit = true;

        return view('guru.attendances.create', compact(
            'classroom',
            'schedule',
            'activeYear',
            'date',
            'students',
            'attendances',
            'isValidated',
            'formAction',
            'isEdit'
        ));
    }

    public function update(Classroom $classroom, Schedule $schedule, $date, Request $request)
    {
        $request->merge(['date' => $date]);

        return $this->store($classroom, $schedule, $request);
    }

    private function validateSchedule(Classroom $classroom, Schedule $schedule, int $teacherId): Schedule
    {
        $schedule = Schedule::with('subject')
            ->where('id', $schedule->id)
            ->where('teacher_id', $teacherId)
            ->where('classroom_id', $classroom->id)
            ->firstOrFail();

        return $schedule;
    }
}
