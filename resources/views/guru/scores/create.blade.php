<x-layouts.guru>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('guru.dashboard')],
            ['label' => 'Kelas Saya', 'url' => route('guru.classes.index')],
            ['label' => $classroom->grade->name . ' ' . $classroom->name, 'url' => route('guru.classes.show', $classroom)],
            ['label' => 'Input Nilai'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold">
            Input Nilai {{ $schedule->subject->name }}
        </h1>

        <p class="text-sm text-gray-500">
            {{ $classroom->grade->name }} {{ $classroom->name }}
            · Tahun Akademik {{ $activeYear->year }}
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('guru.scores.store') }}">
        @csrf

        <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
        <input type="hidden" name="subject_id" value="{{ $schedule->subject->id }}">

        {{-- PILIHAN NILAI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="label">Semester</label>
                <select name="semester" class="select select-bordered w-full" required>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>
            </div>

            <div>
                <label class="label">Jenis Penilaian</label>
                <select name="type" class="select select-bordered w-full" required>
                    <option value="tugas">Tugas</option>
                    <option value="uts">UTS</option>
                    <option value="uas">UAS</option>
                </select>
            </div>
        </div>

        {{-- DAFTAR SISWA --}}
        <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th class="w-12">No</th>
                        <th>Nama Siswa</th>
                        <th class="w-32">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->name }}</td>
                            <td>
                                <input type="number"
                                       name="scores[{{ $student->id }}]"
                                       min="0" max="100"
                                       class="input input-bordered w-full">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <button class="btn btn-primary">
                Simpan Nilai
            </button>
        </div>
    </form>
</x-layouts.guru>
