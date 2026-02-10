<x-layouts.admin>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold">Kelas / Rombel</h1>
        <a href="{{ route('admin.classrooms.create') }}" class="btn btn-primary btn-sm">
            Tambah
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tahun</th>
                    <th>Tingkat</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th class="w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $classroom)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $classroom->academicYear->year }}</td>
                        <td>{{ $classroom->grade->name }}</td>
                        <td>{{ $classroom->name }}</td>
                        <td>{{ $classroom->homeroomTeacher->name }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.classrooms.edit', $classroom) }}"
                                   class="btn btn-xs btn-outline">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.classrooms.destroy', $classroom) }}"
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
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>
