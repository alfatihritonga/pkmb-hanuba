<x-layouts.admin>
    <h1 class="text-xl font-semibold mb-6">Roster / Jadwal Pelajaran</h1>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-6">
        <div class="flex gap-2 items-end">
            <div class="w-96">
                <label class="label">Pilih Kelas</label>
                <select name="classroom_id" class="select select-bordered w-full" required>
                    <option value="">Pilih</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" @selected(request('classroom_id') == $classroom->id)>
                            {{ $classroom->academicYear->year }} — {{ $classroom->grade->name }} {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Tampilkan</button>
            @if ($selectedClassroom)
                <a href="{{ route('admin.schedules.create') }}" class="btn btn-outline">
                    Tambah Jadwal
                </a>
            @endif
        </div>
    </form>

    @if ($selectedClassroom)
        <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
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
                            <td class="capitalize">{{ $schedule->day }}</td>
                            <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                            <td>{{ $schedule->subject->name }}</td>
                            <td>{{ $schedule->teacher->name }}</td>
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
                            <td colspan="5" class="text-center text-gray-400">
                                Belum ada jadwal
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</x-layouts.admin>
