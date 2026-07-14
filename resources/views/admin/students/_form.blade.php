<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="label">Nama Siswa</label>
        <input type="text"
               name="name"
               value="{{ old('name', $student->name ?? '') }}"
               class="input input-bordered w-full"
               required>
    </div>

    <div>
        <label class="label">NIS</label>
        <input type="text"
               name="nis"
               value="{{ old('nis', $student->nis ?? '') }}"
               class="input input-bordered w-full"
               inputmode="numeric"
               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
               required>
    </div>

    <div>
        <label class="label">NISN</label>
        <input type="text"
               name="nisn"
               value="{{ old('nisn', $student->nisn ?? '') }}"
               class="input input-bordered w-full"
               inputmode="numeric"
               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
               required>
    </div>

    <div>
        <label class="label">Jenis Kelamin</label>
        <select name="gender" class="select select-bordered w-full" required>
            <option value="">Pilih</option>
            <option value="L" @selected(old('gender', $student->gender ?? '') === 'L')>Laki-laki</option>
            <option value="P" @selected(old('gender', $student->gender ?? '') === 'P')>Perempuan</option>
        </select>
    </div>

    <div>
        <label class="label">Tanggal Lahir</label>
        <input type="date"
               name="birth_date"
               value="{{ old('birth_date', $student->birth_date ?? '') }}"
               class="input input-bordered w-full">
    </div>

    <div class="md:col-span-2">
        <label class="label">Alamat</label>
        <textarea name="address"
                  class="textarea textarea-bordered w-full"
                  rows="3">{{ old('address', $student->address ?? '') }}</textarea>
    </div>
</div>
