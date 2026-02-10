<x-layouts.admin>
    <h1 class="text-xl font-semibold mb-6">
        {{ isset($schedule) ? 'Edit Jadwal' : 'Tambah Jadwal' }}
    </h1>

    <form method="POST"
          action="{{ isset($schedule)
              ? route('admin.schedules.update', $schedule)
              : route('admin.schedules.store') }}"
          class="space-y-6">
        @csrf
        @isset($schedule)
            @method('PUT')
        @endisset

        @include('admin.schedules._form')

        <div class="flex gap-2">
            <button class="btn btn-primary">
                {{ isset($schedule) ? 'Update' : 'Simpan' }}
            </button>
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-ghost">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>
