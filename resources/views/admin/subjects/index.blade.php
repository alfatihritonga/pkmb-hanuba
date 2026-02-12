<x-layouts.admin>
    @php
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Data'],
            ['label' => 'Mata Pelajaran'],
        ];
    @endphp
    <x-ui.breadcrumbs :items="$breadcrumbs" />

    <div class="flex flex-wrap justify-between mb-4">
        <div class="mb-4 md:mb-0">
            <h1 class="text-xl sm:text-2xl font-bold">Mata Pelajaran</h1>
            <p class="text-sm font-normal opacity-60">Daftar mata pelajaran</p>
        </div>
        
        <div class="self-center">
            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">
                <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14m-7 7V5"/>
                </svg>
                Tambah
            </a>
        </div>
    </div>
    
    @if (session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    
    @if (session('error'))
    <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif
    
    <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th class="w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration + $subjects->firstItem() - 1 }}</td>
                    <td class="font-mono">{{ $subject->code }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>
                        <div class="flex gap-1">
                            <div class="tooltip" data-tip="Edit">
                                <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-outline btn-sm rounded-sm">
                                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            
                            <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <div class="tooltip" data-tip="Hapus">
                                    <button class="btn btn-error btn-outline btn-sm rounded-sm">
                                        <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $subjects->links() }}
    </div>
</x-layouts.admin>
