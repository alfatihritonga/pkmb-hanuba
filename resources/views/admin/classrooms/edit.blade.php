<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Data'],
            ['label' => 'Kelas', 'url' => route('admin.classrooms.index')],
            ['label' => 'Edit'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <h1 class="text-xl font-semibold mb-6">Edit Kelas</h1>

    <form method="POST"
          action="{{ route('admin.classrooms.update', $classroom) }}"
          class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.classrooms._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.classrooms.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
