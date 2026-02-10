<x-layouts.admin>
    <h1 class="text-xl font-semibold mb-6">Tambah Kelas</h1>

    <form method="POST" action="{{ route('admin.classrooms.store') }}" class="space-y-6">
        @csrf
        @include('admin.classrooms._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.classrooms.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
