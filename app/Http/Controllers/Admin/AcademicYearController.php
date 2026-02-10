<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::orderByDesc('year')->get();

        return view('admin.academic-years.index', compact('academicYears'));
    }

    public function create()
    {
        return view('admin.academic-years.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|unique:academic_years,year',
            'is_active' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($request) {

            if ($request->boolean('is_active')) {
                AcademicYear::where('is_active', true)->update(['is_active' => false]);
            }

            AcademicYear::create([
                'year' => $request->year,
                'is_active' => $request->boolean('is_active'),
            ]);
        });

        return redirect()
            ->route('admin.academic-years.index')
            ->with('success', 'Tahun akademik berhasil ditambahkan');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'year' => 'required|unique:academic_years,year,' . $academicYear->id,
            'is_active' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($request, $academicYear) {

            if ($request->boolean('is_active')) {
                AcademicYear::where('is_active', true)
                    ->where('id', '!=', $academicYear->id)
                    ->update(['is_active' => false]);
            }

            $academicYear->update([
                'year' => $request->year,
                'is_active' => $request->boolean('is_active'),
            ]);
        });

        return redirect()
            ->route('admin.academic-years.index')
            ->with('success', 'Tahun akademik berhasil diperbarui');
    }

    public function destroy(AcademicYear $academicYear)
    {
        if ($academicYear->is_active) {
            return back()->with('error', 'Tahun akademik aktif tidak bisa dihapus');
        }

        $academicYear->delete();

        return back()->with('success', 'Tahun akademik berhasil dihapus');
    }
}
