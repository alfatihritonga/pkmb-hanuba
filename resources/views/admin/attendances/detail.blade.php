<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Monitoring'],
            ['label' => 'Monitoring Absensi', 'url' => route('admin.attendances.index')],
            ['label' => $classroom->grade->name . ' ' . $classroom->name, 'url' => route('admin.attendances.show', $classroom) . '?academic_year_id=' . request('academic_year_id')],
            ['label' => 'Detail'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
        <div>
            <h1 class="text-xl font-semibold">Detail Absensi</h1>
            <p class="text-sm text-gray-500">
                {{ $classroom->grade->name }} {{ $classroom->name }}
                · {{ $schedule->subject->name }}
            </p>
        </div>
        <div class="text-sm text-gray-500">
            Tanggal: <span class="font-medium text-gray-700">{{ \Illuminate\Support\Carbon::parse($date)->format('d M Y') }}</span>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <div class="flex flex-wrap items-center gap-3 mb-4">
        <a href="{{ route('admin.attendances.show', $classroom) }}?academic_year_id={{ request('academic_year_id') }}" class="btn btn-sm btn-ghost">
            Kembali
        </a>

        @if (! $isValidated)
            <form method="POST" action="{{ route('admin.attendances.validate', [$classroom, $schedule, $date]) }}?academic_year_id={{ request('academic_year_id') }}">
                @csrf
                <button class="btn btn-sm btn-primary">Validasi</button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.attendances.revoke', [$classroom, $schedule, $date]) }}?academic_year_id={{ request('academic_year_id') }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline">Batalkan Validasi</button>
            </form>
        @endif
    </div>

    <div class="bg-base-100 rounded-lg shadow">
        <div class="flex flex-col gap-1 px-4 py-3 border-b">
            <h2 class="font-semibold">Daftar Absensi</h2>
            <p class="text-sm text-gray-500">Absensi yang belum diinput ditampilkan sebagai "-".</p>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th class="text-center">Status</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        @php
                            $attendance = $student->attendances->first();
                        @endphp
                        <tr>
                            <td class="font-medium">{{ $student->name }}</td>
                            <td class="text-center">
                                <span class="badge badge-ghost">
                                    {{ $attendance->status ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $attendance->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-gray-400">
                                Belum ada data absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
