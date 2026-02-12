<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Monitoring'],
            ['label' => 'Monitoring Nilai', 'url' => route('admin.scores.index')],
            ['label' => $classroom->grade->name . ' ' . $classroom->name, 'url' => route('admin.scores.show', $classroom) . '?academic_year_id=' . request('academic_year_id')],
            ['label' => 'Detail'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
        <div>
            <h1 class="text-xl font-semibold">Detail Nilai Siswa</h1>
            <p class="text-sm text-gray-500">Ringkasan nilai per siswa agar mudah dibaca.</p>
        </div>
        <div class="text-sm text-gray-500">
            Total siswa: <span class="font-medium text-gray-700">{{ count($students) }}</span>
        </div>
    </div>

    <div class="bg-base-100 rounded-lg shadow">
        <div class="flex flex-col gap-1 px-4 py-3 border-b">
            <h2 class="font-semibold">Daftar Nilai</h2>
            <p class="text-sm text-gray-500">Nilai yang belum diinput ditampilkan sebagai &quot;-&quot;.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th class="text-center">Tugas</th>
                        <th class="text-center">UTS</th>
                        <th class="text-center">UAS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        @php
                            $scores = $student->scores->keyBy('type');
                        @endphp
                        <tr>
                            <td class="font-medium">{{ $student->name }}</td>
                            <td class="text-center">
                                <span class="badge badge-ghost">{{ $scores['tugas']->score ?? '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-ghost">{{ $scores['uts']->score ?? '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-ghost">{{ $scores['uas']->score ?? '-' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-400">
                                Belum ada data nilai siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
