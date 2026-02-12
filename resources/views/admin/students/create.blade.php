<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Data'],
            ['label' => 'Siswa', 'url' => route('admin.students.index')],
            ['label' => 'Tambah'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <h1 class="text-xl font-semibold mb-6">Tambah Siswa</h1>

    <form method="POST" action="{{ route('admin.students.store') }}" class="space-y-6">
        @csrf
        @include('admin.students._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
