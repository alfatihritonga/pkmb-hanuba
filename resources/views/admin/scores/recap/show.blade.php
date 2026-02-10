<x-layouts.admin>
    <div class="flex flex-wrap justify-between mb-4">
        <div class="mb-4 md:mb-0">
            <h1 class="text-xl sm:text-2xl font-bold">Monitoring Nilai</h1>
            <p class="text-sm font-normal opacity-60">Rekap Nilai Kelas {{ $classroom->name }} - {{ $classroom->grade->name }}</p>
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
            <form method="GET" class="mb-4">
                <label class="select select-sm">
                    <span class="label">
                        <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                        </svg>
                        Semester
                    </span>
                    <select name="semester" id="semester" class="select select-sm" onchange="this.form.submit()">
                        <option value="ganjil" @selected($semester === 'ganjil')>Ganjil</option>
                        <option value="genap" @selected($semester === 'genap')>Genap</option>
                    </select>
                </label>
            </form>
        </div>
    </div>
    
    <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Indikator Nilai</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recaps as $item)
                <tr>
                    <td>{{ $item['subject']->name }}</td>
                    <td>{{ $item['teacher']->name }}</td>
                    <td class="whitespace-nowrap">
                        <div class="outline-1 outline-base-content/30 rounded-full w-fit p-1">
                            <span class="badge badge-soft rounded-r-none {{ $item['statuses']['tugas'] ? 'badge-success' : 'badge-error' }}">
                                Tugas
                            </span>
                            <span class="badge badge-soft rounded-none {{ $item['statuses']['uts'] ? 'badge-success' : 'badge-error' }}">
                                UTS
                            </span>
                            <span class="badge badge-soft rounded-l-none {{ $item['statuses']['uas'] ? 'badge-success' : 'badge-error' }}">
                                UAS
                            </span>
                        </div>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('admin.scores.detail', [$classroom, $item['subject']->id]) }}?academic_year_id={{ request('academic_year_id') }}&semester={{ request('semester', 'ganjil') }}" class="btn btn-sm btn-outline">
                            Lihat Detail
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>
