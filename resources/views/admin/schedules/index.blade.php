<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Akademik'],
            ['label' => 'Roster'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-xl font-semibold">Roster / Jadwal Pelajaran</h1>
            <p class="text-sm text-gray-500">Kelola roster per kelas agar jadwal mudah dipantau.</p>
        </div>
        @if ($selectedClassroom)
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
                Tambah Jadwal
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-6">
        <div class="bg-base-100 rounded-lg shadow p-4">
            <div class="grid gap-3 md:grid-cols-[1fr_auto] md:items-end">
                <div class="w-full">
                    <label class="label">
                        <span class="label-text">Pilih Kelas</span>
                    </label>
                    <select name="classroom_id" class="select select-bordered w-full" required>
                        <option value="">Pilih</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" @selected(request('classroom_id') == $classroom->id)>
                                {{ $classroom->academicYear->year }} — {{ $classroom->grade->name }} {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row">
                    <button class="btn btn-primary w-full sm:w-auto">Tampilkan</button>
                    @if (request('classroom_id'))
                        <a href="{{ url()->current() }}" class="btn btn-ghost w-full sm:w-auto">
                            Reset
                        </a>
                    @endif
                </div>
            </div>

            @if ($selectedClassroom)
                <div class="mt-3 text-sm text-gray-500">
                    Menampilkan jadwal untuk:
                    <span class="font-medium text-gray-700">
                        {{ $selectedClassroom->academicYear->year }} — {{ $selectedClassroom->grade->name }} {{ $selectedClassroom->name }}
                    </span>
                </div>
            @else
                <div class="mt-3 text-sm text-gray-500">
                    Pilih kelas terlebih dahulu untuk melihat roster.
                </div>
            @endif
        </div>
    </form>

    @if ($selectedClassroom)
        <div class="bg-base-100 rounded-lg shadow">
            <div class="flex flex-col gap-1 px-4 py-3 border-b">
                <h2 class="font-semibold">Daftar Jadwal</h2>
                <p class="text-sm text-gray-500">{{ count($schedules) }} jadwal terdaftar</p>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mapel</th>
                            <th>Guru</th>
                            <th class="w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td class="capitalize">
                                    <span class="badge badge-ghost">{{ $schedule->day }}</span>
                                </td>
                                <td>
                                    <span class="font-mono text-sm">{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                                </td>
                                <td class="font-medium">{{ $schedule->subject->name }}</td>
                                <td class="text-sm text-gray-600">{{ $schedule->teacher->name }}</td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="{{ route('admin.schedules.edit', $schedule) }}"
                                           class="btn btn-xs btn-outline">
                                            Edit
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.schedules.destroy', $schedule) }}"
                                              onsubmit="return confirm('Yakin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-xs btn-error btn-outline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400">
                                    Belum ada jadwal untuk kelas ini. Gunakan tombol &quot;Tambah Jadwal&quot; untuk mulai mengisi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-layouts.admin>
