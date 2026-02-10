<x-layouts.guru>
    <h1 class="text-xl font-semibold mb-2">Kelas yang Diampu</h1>
    <p class="text-sm text-gray-500 mb-6">
        Tahun Akademik {{ $activeYear->year }}
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($classes as $classroomGroup)
            @php
                $item = $classroomGroup->first();
                $classroom = $item->classroom;
            @endphp

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">
                        {{ $classroom->grade->name }}
                        {{ $classroom->name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        Mata Pelajaran:
                        {{ $classroomGroup->pluck('subject.name')->join(', ') }}
                    </p>

                    <div class="card-actions justify-end">
                        <a href="{{ route('guru.classes.show', $classroom) }}"
                           class="btn btn-sm btn-primary">
                            Lihat Kelas
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                Anda belum memiliki kelas yang diampu pada tahun akademik ini.
            </div>
        @endforelse
    </div>
</x-layouts.guru>
