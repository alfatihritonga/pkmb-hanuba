<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassAssignment;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassAssignmentController extends Controller
{
    /**
     * Halaman utama registrasi kelas
     */
    public function index(Request $request)
    {
        $classrooms = Classroom::with(['grade', 'academicYear'])
            ->orderByDesc('academic_year_id')
            ->get();

        $selectedClassroom = null;
        $assignedAssignments = collect();

        if ($request->filled('classroom_id')) {
            $selectedClassroom = Classroom::findOrFail($request->classroom_id);

            $assignedAssignments = $selectedClassroom
                ->classAssignments()
                ->with('student')
                ->get();
        }

        return view('admin.class-assignments.index', compact(
            'classrooms',
            'selectedClassroom',
            'assignedAssignments'
        ));
    }

    /**
     * AJAX search siswa
     */
    public function searchStudent(Request $request)
    {
        $q = $request->get('q');

        if (! $q || strlen($q) < 2) {
            return response()->json([]);
        }

        $students = Student::query()
            ->where('name', 'like', "%{$q}%")
            ->orWhere('nis', 'like', "%{$q}%")
            ->orderBy('name')
            ->limit(10)
            ->get(['id', 'nis', 'name']);

        return response()->json($students);
    }

    /**
     * Simpan registrasi kelas (bulk)
     */
    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'students'     => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->students as $studentId) {
                ClassAssignment::firstOrCreate([
                    'student_id'   => $studentId,
                    'classroom_id' => $request->classroom_id,
                ]);
            }
        });

        return redirect()
            ->back()
            ->with('success', 'Registrasi kelas berhasil disimpan');
    }

    /**
     * Keluarkan siswa dari kelas
     */
    public function destroy(ClassAssignment $classAssignment)
    {
        $classAssignment->delete();

        return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas');
    }
}
