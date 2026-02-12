<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->paginate(10);

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:subjects,code|max:10',
            'name' => 'required',
        ]);

        Subject::create([
            'code' => strtoupper($request->code),
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'code' => 'required|max:10|unique:subjects,code,' . $subject->id,
            'name' => 'required',
        ]);

        $subject->update([
            'code' => strtoupper($request->code),
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    public function destroy(Subject $subject)
    {
        if ($subject->schedules()->exists() || $subject->scores()->exists()) {
            return back()->with('error', 'Mata pelajaran masih digunakan');
        }

        $subject->delete();

        return back()->with('success', 'Mata pelajaran berhasil dihapus');
    }
}
