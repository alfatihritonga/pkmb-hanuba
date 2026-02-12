
<x-layouts.guru>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('guru.dashboard')],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <h1 class="text-xl font-semibold mb-4">
        Selamat datang, {{ auth()->user()->name }}
    </h1>
    
    <div class="alert alert-info">
        Silakan pilih menu <b>Kelas Saya</b> untuk mulai mengajar.
    </div>
</x-layouts.guru>