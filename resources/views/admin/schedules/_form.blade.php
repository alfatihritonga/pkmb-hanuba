<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="label">Kelas</label>
        <select name="classroom_id" class="select select-bordered w-full" required>
            <option value="">Pilih</option>
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}"
                    @selected(old('classroom_id', $schedule->classroom_id ?? '') == $classroom->id)>
                    {{ $classroom->academicYear->year }} —
                    {{ $classroom->grade->name }} {{ $classroom->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="label">Mata Pelajaran</label>
        <select name="subject_id" class="select select-bordered w-full" required>
            <option value="">Pilih</option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"
                    @selected(old('subject_id', $schedule->subject_id ?? '') == $subject->id)>
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="label">Guru</label>
        <select name="teacher_id" class="select select-bordered w-full" required>
            <option value="">Pilih</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}"
                    @selected(old('teacher_id', $schedule->teacher_id ?? '') == $teacher->id)>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="label">Hari</label>
        <select name="day" class="select select-bordered w-full" required>
            @foreach (['senin','selasa','rabu','kamis','jumat','sabtu'] as $day)
                <option value="{{ $day }}"
                    @selected(old('day', $schedule->day ?? '') == $day)>
                    {{ ucfirst($day) }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="label">Jam Mulai</label>
        <input type="time"
               name="start_time"
               value="{{ old('start_time', $schedule->start_time ?? '') }}"
               class="input input-bordered w-full"
               required>
    </div>

    <div>
        <label class="label">Jam Selesai</label>
        <input type="time"
               name="end_time"
               value="{{ old('end_time', $schedule->end_time ?? '') }}"
               class="input input-bordered w-full"
               required>
    </div>
</div>
