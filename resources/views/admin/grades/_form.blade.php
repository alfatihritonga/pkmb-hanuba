<div class="flex flex-col gap-2">
    <label for="name" class="text-sm font-semibold">Nama Tingkat Kelas</label>
    <input type="text" name="name" value="{{ old('name', $grade->name ?? '') }}" placeholder="I / VII / X - 1 / 7 / 10" class="input w-full bg-base-200" required>
</div>

