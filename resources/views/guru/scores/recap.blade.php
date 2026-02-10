<x-layouts.guru>
    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold">
            Rekap Nilai {{ $schedule->subject->name }}
        </h1>

        <p class="text-sm text-gray-500">
            {{ $classroom->grade->name }} {{ $classroom->name }}
            · Tahun Akademik {{ $activeYear->year }}
        </p>
    </div>

    {{-- FILTER SEMESTER --}}
    <form method="GET" class="mb-4">
        <label class="label">Semester</label>
        <select name="semester"
                class="select select-bordered w-40"
                onchange="this.form.submit()">
            <option value="ganjil" @selected($semester === 'ganjil')>
                Ganjil
            </option>
            <option value="genap" @selected($semester === 'genap')>
                Genap
            </option>
        </select>
    </form>

    {{-- TABEL REKAP --}}
    <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th class="w-24 text-center">Tugas</th>
                    <th class="w-24 text-center">UTS</th>
                    <th class="w-24 text-center">UAS</th>
                    <th class="w-32 text-center">Rata-rata</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    @php
                        $scores = $student->scores->keyBy('type');
                        $tugas = $scores['tugas']->score ?? null;
                        $uts   = $scores['uts']->score ?? null;
                        $uas   = $scores['uas']->score ?? null;

                        $avg = collect([$tugas, $uts, $uas])
                                ->filter()
                                ->avg();
                    @endphp

                    <tr>
                        <td>{{ $student->name }}</td>
                        <td class="text-center">{{ $tugas ?? '-' }}</td>
                        <td class="text-center">{{ $uts ?? '-' }}</td>
                        <td class="text-center">{{ $uas ?? '-' }}</td>
                        <td class="text-center font-medium">
                            {{ $avg ? number_format($avg, 1) : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-400">
                            Belum ada data nilai.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.guru>
