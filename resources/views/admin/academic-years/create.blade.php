<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Data'],
            ['label' => 'Tahun Akademik', 'url' => route('admin.academic-years.index')],
            ['label' => 'Tambah'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="mb-4">
        <h1 class="text-xl sm:text-2xl font-bold">Tambah Tahun Akademik</h1>
        <p class="text-sm font-normal opacity-60">Tambah data tahun akademik</p>
    </div>

    <form method="POST" action="{{ route('admin.academic-years.store') }}" class="space-y-6">
        @csrf
        @include('admin.academic-years._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.academic-years.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
