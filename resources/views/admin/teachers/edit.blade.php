<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Data'],
            ['label' => 'Guru', 'url' => route('admin.teachers.index')],
            ['label' => 'Edit'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <h1 class="text-xl font-semibold mb-6">Edit Guru</h1>

    <form method="POST"
          action="{{ route('admin.teachers.update', $teacher) }}"
          class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.teachers._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
