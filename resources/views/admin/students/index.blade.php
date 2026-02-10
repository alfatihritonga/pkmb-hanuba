<x-layouts.admin>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold">Siswa</h1>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-sm">
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
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th class="w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.students.edit', $student) }}"
                                   class="btn btn-xs btn-outline">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.students.destroy', $student) }}"
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
