<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->orderBy('name')->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'nip'    => 'required|unique:teachers,nip',
            'gender' => 'required|in:L,P',
            'email'  => 'required|email|unique:users,email',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt('password'),
                'role'     => 'guru',
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'nip'     => $request->nip,
                'name'    => $request->name,
                'gender'  => $request->gender,
                'phone'   => $request->phone,
            ]);
        });

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');

        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'   => 'required',
            'nip'    => 'required|unique:teachers,nip,' . $teacher->id,
            'gender' => 'required|in:L,P',
            'email'  => 'required|email|unique:users,email,' . $teacher->user_id,
        ]);

        DB::transaction(function () use ($request, $teacher) {

            $teacher->user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            $teacher->update([
                'nip'    => $request->nip,
                'name'   => $request->name,
                'gender' => $request->gender,
                'phone'  => $request->phone,
            ]);
        });

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Guru berhasil diperbarui');
    }

    public function destroy(Teacher $teacher)
    {
        // safety check
        if (
            $teacher->classrooms()->exists() ||
            $teacher->schedules()->exists()
        ) {
            return back()->with('error', 'Guru masih digunakan');
        }

        DB::transaction(function () use ($teacher) {
            $teacher->user()->delete();
            $teacher->delete();
        });

        return back()->with('success', 'Guru berhasil dihapus');
    }
}
