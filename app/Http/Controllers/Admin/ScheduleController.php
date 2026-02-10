<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::with(['grade', 'academicYear'])->get();
        $schedules = collect();
        $selectedClassroom = null;

        if ($request->filled('classroom_id')) {
            $selectedClassroom = Classroom::findOrFail($request->classroom_id);

            $schedules = Schedule::with(['subject', 'teacher'])
                ->where('classroom_id', $selectedClassroom->id)
                ->orderBy('day')
                ->orderBy('start_time')
                ->get();
        }

        return view('admin.schedules.index', compact(
            'classrooms',
            'schedules',
            'selectedClassroom'
        ));
    }

    public function create(Request $request)
    {
        $classrooms = Classroom::with(['grade', 'academicYear'])->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.schedules.create', compact(
            'classrooms',
            'subjects',
            'teachers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id'   => 'required|exists:subjects,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'day'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'start_time'   => 'required',
            'end_time'     => 'required|after:start_time',
        ]);

        Schedule::create($request->all());

        return redirect()
            ->route('admin.schedules.index', ['classroom_id' => $request->classroom_id])
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(Schedule $schedule)
    {
        $classrooms = Classroom::with(['grade', 'academicYear'])->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.schedules.edit', compact(
            'schedule',
            'classrooms',
            'subjects',
            'teachers'
        ));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id'   => 'required|exists:subjects,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'day'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'start_time'   => 'required',
            'end_time'     => 'required|after:start_time',
        ]);

        $schedule->update($request->all());

        return redirect()
            ->route('admin.schedules.index', ['classroom_id' => $request->classroom_id])
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(Schedule $schedule)
    {
        $classroomId = $schedule->classroom_id;
        $schedule->delete();

        return redirect()
            ->route('admin.schedules.index', ['classroom_id' => $classroomId])
            ->with('success', 'Jadwal berhasil dihapus');
    }
}
