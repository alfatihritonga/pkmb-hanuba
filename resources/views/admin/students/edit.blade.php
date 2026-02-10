<x-layouts.admin>
    <h1 class="text-xl font-semibold mb-6">Edit Siswa</h1>

    <form method="POST"
          action="{{ route('admin.students.update', $student) }}"
          class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.students._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
