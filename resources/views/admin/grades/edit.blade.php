<x-layouts.admin>
    <h1 class="text-xl font-semibold mb-6">Edit Tingkat Kelas</h1>

    <form method="POST"
          action="{{ route('admin.grades.update', $grade) }}"
          class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.grades._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.grades.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
