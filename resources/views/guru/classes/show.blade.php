<x-layouts.guru>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('guru.dashboard')],
            ['label' => 'Kelas Saya', 'url' => route('guru.classes.index')],
            ['label' => $classroom->grade->name . ' ' . $classroom->name],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold">
            {{ $classroom->grade->name }} {{ $classroom->name }}
        </h1>
        
        <p class="text-sm text-gray-500">
            Tahun Akademik {{ $activeYear->year }}
        </p>
        
        <p class="text-sm mt-1">
            Mata Pelajaran:
            <span class="font-medium">
                {{ $schedules->pluck('subject.name')->join(', ') }}
            </span>
        </p>
    </div>
    
    {{-- AKSI UTAMA --}}
    <div class="space-y-4 mb-6">
        @foreach ($schedules as $schedule)
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h3 class="font-semibold">
                    Mata Pelajaran: {{ $schedule->subject->name }}
                </h3>
                
                <div class="flex flex-wrap gap-2 mt-3">
                    <a href="{{ route('guru.scores.create', [$classroom, $schedule->subject]) }}"
                        class="btn btn-sm btn-primary">
                        Input Nilai
                    </a>

                    <a href="{{ route('guru.scores.recap', [$classroom, $schedule->subject]) }}"
                        class="btn btn-sm btn-outline">
                        Rekap Nilai
                    </a>

                    <a href="{{ route('guru.attendances.index', [$classroom, $schedule]) }}"
                        class="btn btn-sm btn-ghost">
                        Absensi
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{-- DAFTAR SISWA --}}
    <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th class="w-12">No</th>
                    <th class="w-40">NIS</th>
                    <th>Nama Siswa</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-400">
                        Belum ada siswa terdaftar pada kelas ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.guru>
