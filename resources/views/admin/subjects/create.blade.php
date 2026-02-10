<x-layouts.admin>
    <div class="mb-4">
        <h1 class="text-xl sm:text-2xl font-bold">Tambah Mata Pelajaran</h1>
        <p class="text-sm font-normal opacity-60">Tambah data mata pelajaran</p>
    </div>

    <form method="POST" action="{{ route('admin.subjects.store') }}" class="space-y-6">
        @csrf
        @include('admin.subjects._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
