<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Akademik'],
            ['label' => 'Registrasi Kelas'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <h1 class="text-xl font-semibold mb-6">Registrasi Kelas</h1>

    @if (session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif
    
    {{-- PILIH KELAS --}}
    <form method="GET" class="mb-6">
        <div class="flex items-end gap-2">
            <div class="w-96">
                <label class="label">Pilih Kelas</label>
                <select name="classroom_id" class="select select-bordered w-full" required>
                    <option value="">Pilih</option>
                    @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}"
                        @selected(request('classroom_id') == $classroom->id)>
                        {{ $classroom->academicYear->year }} — {{ $classroom->grade->name }} {{ $classroom->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <button class="btn btn-primary">
                Tampilkan
            </button>
        </div>
    </form>
    
    @if ($selectedClassroom)
    <div x-data="classAssignment()" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- KOLOM KIRI --}}
        <div>
            <h2 class="font-semibold mb-2">Cari Siswa</h2>
            
            <input type="text" x-model="query" @input.debounce.500ms="search" placeholder="Nama / NIS" class="input input-bordered w-full">
            
            <ul x-show="results.length" class="mt-2 bg-base-100 rounded shadow divide-y">
                <template x-for="student in results" :key="student.id">
                    <li class="flex justify-between items-center p-2 hover:bg-base-200">
                        <span x-text="student.name + ' (' + student.nis + ')'"></span>
                        <button @click="add(student)" class="btn btn-xs btn-primary">
                            Tambah
                        </button>
                    </li>
                </template>
            </ul>
            
            {{-- SISWA TERDAFTAR --}}
            <h2 class="font-semibold mt-6 mb-2">Siswa Terdaftar</h2>
            
            <div class="bg-base-100 rounded shadow overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th class="w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignedAssignments as $assignment)
                        <tr>
                            <td>{{ $assignment->student->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.class-assignments.destroy', $assignment->id) }}" onsubmit="return confirm('Keluarkan siswa dari kelas?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-error">
                                        Keluarkan
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- KOLOM KANAN --}}
        <div>
            <h2 class="font-semibold mb-2">Draft Registrasi</h2>
            
            <div class="bg-base-100 rounded shadow p-4 space-y-2">
                <template x-for="student in selected" :key="student.id">
                    <div class="flex justify-between items-center border-b pb-2">
                        <span x-text="student.name"></span>
                        <button @click="remove(student.id)" class="btn btn-xs btn-error">
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                        </button>
                    </div>
                </template>
                
                <p x-show="selected.length === 0" class="text-sm text-gray-400">
                    Belum ada siswa dipilih
                </p>
            </div>
            
            {{-- SUBMIT --}}
            <form method="POST" action="{{ route('admin.class-assignments.store') }}" class="mt-4">
                @csrf
                <input type="hidden" name="classroom_id" value="{{ $selectedClassroom->id }}">
                
                <template x-for="student in selected">
                    <input type="hidden" name="students[]" :value="student.id">
                </template>
                
                <button class="btn btn-primary w-full" :disabled="selected.length === 0">
                    Simpan Registrasi
                </button>
            </form>
        </div>
    </div>
    @endif
    
    <script>
        function classAssignment() {
            return {
                query: '',
                results: [],
                selected: [],
                
                search() {
                    if (this.query.length < 2) {
                        this.results = []
                        return
                    }
                    
                    fetch(`{{ route('admin.students.search') }}?q=${this.query}`)
                    .then(res => res.json())
                    .then(data => this.results = data)
                },
                
                add(student) {
                    if (! this.selected.find(s => s.id === student.id)) {
                        this.selected.push(student)
                    }
                    
                    // hapus siswa yg sudah ditambahkan dari hasil pencarian
                    this.results = this.results.filter(s => s.id !== student.id)
                },
                
                remove(id) {
                    this.selected = this.selected.filter(s => s.id !== id)
                }
            }
        }
    </script>
</x-layouts.admin>
