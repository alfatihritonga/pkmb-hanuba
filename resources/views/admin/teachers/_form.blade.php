<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="flex flex-col gap-2">
        <label for="name" class="text-sm font-semibold">Nama Guru</label>
        <input type="text" name="name" value="{{ old('name', $teacher->name ?? '') }}" class="input w-full bg-base-200" required>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="nip" class="text-sm font-semibold">NIP</label>
        <input type="text" name="nip" value="{{ old('nip', $teacher->nip ?? '') }}" class="input w-full bg-base-200" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="email" class="text-sm font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email', $teacher->user->email ?? '') }}" class="input w-full bg-base-200" required>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="phone" class="text-sm font-semibold">No. Hp</label>
        <input type="text" name="phone" value="{{ old('phone', $teacher->phone ?? '') }}" class="input w-full bg-base-200">
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="birth_place" class="text-sm font-semibold">Tempat Lahir</label>
        <input type="text" name="birth_place" value="{{ old('birth_place', $teacher->birth_place ?? '') }}" class="input w-full bg-base-200">
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="birth_date" class="text-sm font-semibold">Tanggal Lahir</label>
        <input type="date" name="birth_date" value="{{ old('birth_date', isset($teacher->birth_date) ? $teacher->birth_date->format('Y-m-d') : '') }}" class="input w-full bg-base-200">
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="religion" class="text-sm font-semibold">Agama</label>
        <select name="religion" class="select w-full bg-base-200">
            <option value="">Tidak Diketahui</option>
            <option value="Islam" @selected(old('religion', $teacher->religion ?? '') === 'Islam')>Islam</option>
            <option value="Kristen Protestan" @selected(old('religion', $teacher->religion ?? '') === 'Kristen Protestan')>Kristen Protestan</option>
            <option value="Kristen Katolik" @selected(old('religion', $teacher->religion ?? '') === 'Kristen Katolik')>Kristen Katolik</option>
            <option value="Hindu" @selected(old('religion', $teacher->religion ?? '') === 'Hindu')>Hindu</option>
            <option value="Buddha" @selected(old('religion', $teacher->religion ?? '') === 'Buddha')>Buddha</option>
            <option value="Konghucu" @selected(old('religion', $teacher->religion ?? '') === 'Konghucu')>Konghucu</option>
        </select>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="gender" class="text-sm font-semibold">Jenis Kelamin</label>
        <select name="gender" class="select w-full bg-base-200" required>
            <option value="">Pilih</option>
            <option value="L" @selected(old('gender', $teacher->gender ?? '') === 'L')>Laki-laki</option>
            <option value="P" @selected(old('gender', $teacher->gender ?? '') === 'P')>Perempuan</option>
        </select>
    </div>
</div>

<div class="flex flex-col gap-2">
    <label for="address" class="text-sm font-semibold">Alamat</label>
    <textarea name="address" rows="3" class="textarea w-full bg-base-200">{{ old('address', $teacher->address ?? '') }}</textarea>
</div>

{{-- Hanya tampil saat edit (status ada di update controller) --}}
@isset($teacher)
<div class="flex flex-col gap-2">
    <label for="status" class="text-sm font-semibold">Status</label>
    <select name="status" class="select w-full bg-base-200">
        <option value="active" @selected(old('status', $teacher->status) === 'active')>Aktif</option>
        <option value="inactive" @selected(old('status', $teacher->status) === 'inactive')>Tidak Aktif</option>
    </select>
</div>
@endisset