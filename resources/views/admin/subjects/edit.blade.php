<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Data'],
            ['label' => 'Mata Pelajaran', 'url' => route('admin.subjects.index')],
            ['label' => 'Edit'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="mb-4">
        <h1 class="text-xl sm:text-2xl font-bold">Edit Mata Pelajaran</h1>
        <p class="text-sm font-normal opacity-60">Edit data mata pelajaran</p>
    </div>
    <form method="POST" action="{{ route('admin.subjects.update', $subject) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        @include('admin.subjects._form')
        
        <div class="flex gap-2">
            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
