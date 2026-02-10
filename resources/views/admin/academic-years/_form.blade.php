<div class="space-y-4">
    <div class="flex flex-col gap-2">
        <label for="year" class="text-sm font-semibold">Tahun Akademik</label>
        <input type="text" name="year" value="{{ old('year', $academicYear->year ?? '') }}" placeholder="2025/2026" class="input w-full bg-base-200" required>
    </div>
    
    <div class="">
        <label class="cursor-pointer flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" class="checkbox checkbox-primary checkbox-sm rounded" {{ old('is_active', $academicYear->is_active ?? false) ? 'checked' : '' }}>
            <span class="text-sm">Jadikan Tahun Aktif</span>
        </label>
    </div>
</div>
