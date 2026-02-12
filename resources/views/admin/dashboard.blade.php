<x-layouts.admin>
    <div class="space-y-6">

        @php
            $breadcrumbs = [
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ];
        @endphp
        <x-ui.breadcrumbs :items="$breadcrumbs" />

        {{-- Header --}}
        <div>
            <h1 class="text-xl font-semibold">Dashboard</h1>
            <p class="text-sm text-gray-500">
                Ringkasan kondisi dan kesiapan sistem akademik.
            </p>
        </div>

        {{-- Tahun Akademik Aktif --}}
        <div class="card bg-base-200 shadow">
            <div class="card-body">
                <h2 class="card-title">Tahun Akademik Aktif</h2>

                @if ($activeYear)
                    <p class="text-lg font-medium">
                        {{ $activeYear->year }}
                    </p>
                @else
                    <div class="alert alert-warning">
                        Belum ada tahun akademik yang ditetapkan sebagai aktif.
                    </div>
                @endif
            </div>
        </div>

        {{-- Statistik Utama --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="stat bg-base-200 shadow rounded-box">
                <div class="stat-title">Jumlah Kelas</div>
                <div class="stat-value">{{ $totalClasses }}</div>
            </div>

            <div class="stat bg-base-200 shadow rounded-box">
                <div class="stat-title">Jumlah Siswa</div>
                <div class="stat-value">{{ $totalStudents }}</div>
            </div>

            <div class="stat bg-base-200 shadow rounded-box">
                <div class="stat-title">Jumlah Guru</div>
                <div class="stat-value">{{ $totalTeachers }}</div>
            </div>

            <div class="stat bg-base-200 shadow rounded-box">
                <div class="stat-title">Siswa Terdaftar Kelas</div>
                <div class="stat-value">{{ $registeredStudents }}</div>
            </div>
        </div>

        {{-- Kesiapan Sistem --}}
        <div class="card bg-base-200 shadow">
            <div class="card-body">
                <h2 class="card-title">Kesiapan Struktur Akademik</h2>

                <ul class="list-disc ml-5 space-y-1 text-sm">
                    @if ($classesWithoutStudents > 0)
                        <li class="text-warning">
                            {{ $classesWithoutStudents }} kelas belum memiliki siswa terdaftar.
                        </li>
                    @else
                        <li class="text-success">
                            Seluruh kelas telah memiliki siswa terdaftar.
                        </li>
                    @endif

                    @if ($classesWithoutSchedules > 0)
                        <li class="text-warning">
                            {{ $classesWithoutSchedules }} kelas belum memiliki jadwal pelajaran.
                        </li>
                    @else
                        <li class="text-success">
                            Seluruh kelas telah memiliki jadwal pelajaran.
                        </li>
                    @endif
                </ul>
            </div>
        </div>

    </div>
</x-layouts.admin>
