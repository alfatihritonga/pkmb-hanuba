<x-layouts.guru>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('guru.dashboard')],
            ['label' => 'Kelas Saya', 'url' => route('guru.classes.index')],
            ['label' => $classroom->grade->name . ' ' . $classroom->name, 'url' => route('guru.classes.show', $classroom)],
            ['label' => 'Absensi'],
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

    @if (session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
        <div class="text-sm text-gray-500">
            Total pertemuan: <span class="font-medium text-gray-700">{{ $dates->count() }}</span>
        </div>
        <a href="{{ route('guru.attendances.create', [$classroom, $schedule]) }}" class="btn btn-sm btn-primary">
            Input Absensi
        </a>
    </div>

    <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th class="w-40">Tanggal</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dates as $item)
                    <tr>
                        <td>{{ \Illuminate\Support\Carbon::parse($item->date)->format('d M Y') }}</td>
                        <td>
                            <span class="badge badge-soft {{ $item->is_validated ? 'badge-success' : 'badge-warning' }}">
                                {{ $item->is_validated ? 'Tervalidasi' : 'Belum divalidasi' }}
                            </span>
                        </td>
                        <td class="text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('guru.attendances.edit', [$classroom, $schedule, \Illuminate\Support\Carbon::parse($item->date)->format('Y-m-d')]) }}" class="btn btn-sm btn-outline" {{ $item->is_validated ? 'disabled' : '' }}>
                                    Edit
                                </a>
                                <a href="{{ route('guru.attendances.create', [$classroom, $schedule]) }}?date={{ \Illuminate\Support\Carbon::parse($item->date)->format('Y-m-d') }}" class="btn btn-sm btn-ghost">
                                    Lihat
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-400">
                            Belum ada data absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.guru>
