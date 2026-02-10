<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::orderBy('name')->get();

        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        return view('admin.grades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:grades,name',
        ]);

        Grade::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.grades.index')
            ->with('success', 'Tingkat kelas berhasil ditambahkan');
    }

    public function edit(Grade $grade)
    {
        return view('admin.grades.edit', compact('grade'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name' => 'required|unique:grades,name,' . $grade->id,
        ]);

        $grade->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.grades.index')
            ->with('success', 'Tingkat kelas berhasil diperbarui');
    }

    public function destroy(Grade $grade)
    {
        // Optional safety check:
        if ($grade->classrooms()->exists()) {
            return back()->with('error', 'Tingkat kelas masih digunakan oleh kelas');
        }

        $grade->delete();

        return back()->with('success', 'Tingkat kelas berhasil dihapus');
    }
}
