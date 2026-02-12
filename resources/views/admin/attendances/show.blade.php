<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Monitoring'],
            ['label' => 'Monitoring Absensi', 'url' => route('admin.attendances.index')],
            ['label' => $classroom->grade->name . ' ' . $classroom->name],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="flex flex-wrap justify-between mb-4">
        <div class="mb-4 md:mb-0">
            <h1 class="text-xl sm:text-2xl font-bold">Monitoring Absensi</h1>
            <p class="text-sm font-normal opacity-60">Rekap absensi kelas {{ $classroom->name }} - {{ $classroom->grade->name }}</p>
        </div>

        <div class="flex flex-wrap gap-2 self-end">
            <label class="input input-sm w-auto">
                <span class="label">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                    </svg>
                    TA
                </span>
                <input type="text" value="{{ $academicYear->year }}" readonly />
            </label>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Riwayat Absensi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $schedule)
                    @php
                        $items = $dates->get($schedule->id, collect());
                    @endphp
                    <tr>
                        <td>{{ $schedule->subject->name }}</td>
                        <td>{{ $schedule->teacher->name }}</td>
                        <td>
                            @if ($items->isEmpty())
                                <span class="text-gray-400">Belum ada absensi</span>
                            @else
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($items as $item)
                                        <a href="{{ route('admin.attendances.detail', [$classroom, $schedule, \Illuminate\Support\Carbon::parse($item->date)->format('Y-m-d')]) }}?academic_year_id={{ request('academic_year_id') }}"
                                           class="badge badge-soft {{ $item->is_validated ? 'badge-success' : 'badge-warning' }}">
                                            {{ \Illuminate\Support\Carbon::parse($item->date)->format('d M') }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-400">Belum ada data absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
