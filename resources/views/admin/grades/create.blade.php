<x-layouts.admin>
    <div class="mb-4">
        <h1 class="text-xl sm:text-2xl font-bold">Tambah Tingkat Kelas</h1>
        <p class="text-sm font-normal opacity-60">Tambah data tingkat kelas</p>
    </div>

    <form method="POST" action="{{ route('admin.grades.store') }}" class="space-y-6">
        @csrf
        @include('admin.grades._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.grades.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
