<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="label">Tahun Akademik</label>
        <select name="academic_year_id" class="select select-bordered w-full" required>
            <option value="">Pilih</option>
            @foreach ($academicYears as $year)
            <option value="{{ $year->id }}"
                @selected(old('academic_year_id', $classroom->academic_year_id ?? '') == $year->id)>
                {{ $year->year }}
            </option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label class="label">Tingkat Kelas</label>
        <select name="grade_id" class="select select-bordered w-full" required>
            <option value="">Pilih</option>
            @foreach ($grades as $grade)
            <option value="{{ $grade->id }}"
                @selected(old('grade_id', $classroom->grade_id ?? '') == $grade->id)>
                {{ $grade->name }}
            </option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label class="label">Wali Kelas</label>
        <select name="homeroom_teacher_id" class="select select-bordered w-full" required>
            <option value="">Pilih</option>
            @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}"
                @selected(old('homeroom_teacher_id', $classroom->homeroom_teacher_id ?? '') == $teacher->id)>
                {{ $teacher->name }}
            </option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label class="label">Nama Kelas</label>
        <input type="text" name="name" value="{{ old('name', $classroom->name ?? '') }}" placeholder="7-A / VII-A" class="input input-bordered w-full" required>
    </div>
</div>
