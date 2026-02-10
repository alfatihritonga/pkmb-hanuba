<div class="space-y-4">
    <div class="flex flex-col gap-2">
        <label for="code" class="text-sm font-semibold">Kode Mata Pelajaran</label>
        <input type="text" name="code" value="{{ old('code', $subject->code ?? '') }}" placeholder="MTK" class="input w-full bg-base-200 uppercase" required>
    </div>

    <div class="flex flex-col gap-2">
        <label for="name" class="text-sm font-semibold">Nama Mata Pelajaran</label>
        <input type="text" name="name" value="{{ old('name', $subject->name ?? '') }}" placeholder="Matematika" class="input w-full bg-base-200" required>
    </div>
</div>
