<x-layouts.guru>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('guru.dashboard')],
            ['label' => 'Input Nilai'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <h1 class="text-xl font-semibold mb-6">Input Nilai</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($schedules as $classroomGroup)
            @foreach ($classroomGroup as $subjectGroup)
                @php
                    $item = $subjectGroup->first();
                @endphp

                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title">
                            {{ $item->classroom->grade->name }}
                            {{ $item->classroom->name }}
                        </h2>

                        <p class="text-sm">
                            Mata Pelajaran: <b>{{ $item->subject->name }}</b>
                        </p>

                        <div class="card-actions justify-end">
                            <a href="{{ route('guru.scores.create', [
                                $item->classroom,
                                $item->subject
                            ]) }}"
                               class="btn btn-sm btn-primary">
                                Input Nilai
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</x-layouts.guru>
