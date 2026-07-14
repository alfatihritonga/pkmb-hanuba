<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->get('q');

        if (! $q || strlen($q) < 2) {
            return response()->json([]);
        }

        $students = Student::query()
            ->where('name', 'like', "%{$q}%")
            ->orWhere('nis', 'like', "%{$q}%")
            ->limit(100)
            ->get(['id', 'nis', 'name']);

        return response()->json($students);
    }
    
    public function index()
    {
        $students = Student::orderBy('name')->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'nis'   => 'required|regex:/^[0-9]+$/|unique:students,nis',
            'nisn'  => 'required|regex:/^[0-9]+$/|unique:students,nisn',
            'gender'=> 'required|in:L,P',
        ]);

        Student::create([
            'name'       => $request->name,
            'nis'        => $request->nis,
            'nisn'       => $request->nisn,
            'gender'     => $request->gender,
            'birth_date' => $request->birth_date,
            'address'    => $request->address,
        ]);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'  => 'required',
            'nis'   => 'required|regex:/^[0-9]+$/|unique:students,nis,' . $student->id,
            'nisn'  => 'required|regex:/^[0-9]+$/|unique:students,nisn,' . $student->id,
            'gender'=> 'required|in:L,P',
        ]);

        $student->update([
            'name'       => $request->name,
            'nis'        => $request->nis,
            'nisn'       => $request->nisn,
            'gender'     => $request->gender,
            'birth_date' => $request->birth_date,
            'address'    => $request->address,
        ]);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        if (
            $student->classAssignments()->exists() ||
            $student->scores()->exists()
        ) {
            return back()->with('error', 'Siswa masih memiliki data akademik');
        }

        $student->delete();

        return back()->with('success', 'Siswa berhasil dihapus');
    }
}
