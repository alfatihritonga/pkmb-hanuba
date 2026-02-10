<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="flex flex-col gap-2">
        <label for="name" class="text-sm font-semibold">Nama Guru</label>
        <input type="text" name="name" value="{{ old('name', $teacher->name ?? '') }}" class="input w-full bg-base-200" required>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="nip" class="text-sm font-semibold">NIP</label>
        <input type="text" name="nip" value="{{ old('nip', $teacher->nip ?? '') }}" class="input w-full bg-base-200" required>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="email" class="text-sm font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email', $teacher->user->email ?? '') }}" class="input w-full bg-base-200" required>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="phone" class="text-sm font-semibold">No. Hp</label>
        <input type="text" name="phone" value="{{ old('phone', $teacher->phone ?? '') }}" class="input w-full bg-base-200" required>
    </div>
</div>

<div class="flex flex-col gap-2">
    <label for="gender" class="text-sm font-semibold">Jenis Kelamin</label>
    <select name="gender" class="select w-full bg-base-200" required>
        <option value="">Pilih</option>
        <option value="L" @selected(old('gender', $teacher->gender ?? '') === 'L')>Laki-laki</option>
        <option value="P" @selected(old('gender', $teacher->gender ?? '') === 'P')>Perempuan</option>
    </select>
</div>
