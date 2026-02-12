<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Data'],
            ['label' => 'Tahun Akademik', 'url' => route('admin.academic-years.index')],
            ['label' => 'Edit'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="mb-4">
        <h1 class="text-xl sm:text-2xl font-bold">Edit Tahun Akademik</h1>
        <p class="text-sm font-normal opacity-60">Ubah data tahun akademik</p>
    </div>

    <form method="POST" action="{{ route('admin.academic-years.update', $academicYear) }}" class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.academic-years._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.academic-years.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
