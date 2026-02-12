<x-layouts.guru>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('guru.dashboard')],
            ['label' => 'Kelas Saya', 'url' => route('guru.classes.index')],
            ['label' => $classroom->grade->name . ' ' . $classroom->name, 'url' => route('guru.classes.show', $classroom)],
            ['label' => 'Absensi', 'url' => route('guru.attendances.index', [$classroom, $schedule])],
            ['label' => $isEdit ? 'Edit' : 'Input'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="mb-6">
        <h1 class="text-xl font-semibold">
            Absensi {{ $schedule->subject->name }}
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

    @if ($isValidated)
        <div class="alert alert-warning mb-4">
            Absensi tanggal ini sudah divalidasi admin dan tidak bisa diubah.
        </div>
    @endif

    <form method="POST" action="{{ $formAction }}">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="flex flex-wrap items-center gap-3 mb-4">
            <div>
                <label class="label">Tanggal</label>
                <input type="date" name="date_view" value="{{ $date }}" class="input input-bordered" disabled>
            </div>
            <div class="ml-auto">
                <a href="{{ route('guru.attendances.index', [$classroom, $schedule]) }}" class="btn btn-sm btn-ghost">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th class="w-12">No</th>
                        <th>Nama Siswa</th>
                        <th class="w-48">Status</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        @php
                            $attendance = $attendances[$student->id] ?? null;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->name }}</td>
                            <td>
                                <select name="statuses[{{ $student->id }}]" class="select select-bordered w-full" {{ $isValidated ? 'disabled' : '' }}>
                                    <option value="hadir" @selected(($attendance->status ?? '') === 'hadir')>Hadir</option>
                                    <option value="izin" @selected(($attendance->status ?? '') === 'izin')>Izin</option>
                                    <option value="sakit" @selected(($attendance->status ?? '') === 'sakit')>Sakit</option>
                                    <option value="alpha" @selected(($attendance->status ?? '') === 'alpha')>Alpha</option>
                                </select>
                            </td>
                            <td>
                                <input type="text"
                                       name="notes[{{ $student->id }}]"
                                       value="{{ $attendance->notes ?? '' }}"
                                       class="input input-bordered w-full"
                                       {{ $isValidated ? 'disabled' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <button class="btn btn-primary" {{ $isValidated ? 'disabled' : '' }}>
                Simpan Absensi
            </button>
        </div>
    </form>
</x-layouts.guru>
