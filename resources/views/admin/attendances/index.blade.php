<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Monitoring'],
            ['label' => 'Monitoring Absensi'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="flex flex-wrap justify-between mb-4">
        <div class="mb-4 md:mb-0">
            <h1 class="text-xl sm:text-2xl font-bold">Monitoring Absensi</h1>
            <p class="text-sm font-normal opacity-60">Monitoring absensi siswa berdasarkan tahun akademik</p>
        </div>

        <div class="self-end">
            <form action="" method="get">
                <label class="select select-sm">
                    <span class="label">
                        <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                        </svg>
                        TA
                    </span>
                    <select name="academic_year_id" id="academic_year_id" class="select select-sm min-w-32" onchange="this.form.submit()">
                        @foreach ($academicYears as $academicYear)
                        <option value="{{ $academicYear->id }}" @selected(request('academic_year_id') == $academicYear->id)>
                            {{ $academicYear->year }}
                        </option>
                        @endforeach
                    </select>
                </label>
            </form>
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
                    <th>Tingkat</th>
                    <th>Kelas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classrooms as $classroom)
                <tr>
                    <td>{{ $classroom->grade->name }}</td>
                    <td>{{ $classroom->name }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.attendances.show', $classroom) }}?academic_year_id={{ $activeYear->id }}" class="btn btn-sm btn-outline">
                            Lihat Rekap
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-400">
                        Tidak ada kelas pada tahun akademik aktif.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
