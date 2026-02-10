<x-layouts.admin>
    <h1 class="text-xl font-semibold mb-4">Detail Nilai Siswa</h1>

    <div class="bg-base-100 rounded-lg shadow overflow-x-auto">
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
                @foreach ($students as $student)
                    @php
                        $scores = $student->scores->keyBy('type');
                    @endphp
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td class="text-center">{{ $scores['tugas']->score ?? '-' }}</td>
                        <td class="text-center">{{ $scores['uts']->score ?? '-' }}</td>
                        <td class="text-center">{{ $scores['uas']->score ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>
