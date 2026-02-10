<div class="drawer-side is-drawer-close:overflow-visible">
    <label for="sidebar-toggle" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
        <!-- Sidebar content here -->
        <ul class="menu w-full grow">
            
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Dashboard">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Dashboard</span>
                </a>
            </li>

            <li class="is-drawer-close:hidden is-drawer-open:menu-title">
                Master Data
            </li>
            <li class="is-drawer-open:hidden is-drawer-close:menu-title">
            </li>
            
            <li>
                <a href="{{ route('admin.academic-years.index') }}" class="{{ Route::is('admin.academic-years.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Tahun Akademik">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Tahun Akademik</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.grades.index') }}" class="{{ Route::is('admin.grades.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Tingkat Kelas">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Tingkat Kelas</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.subjects.index') }}" class="{{ Route::is('admin.subjects.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Mata Pelajaran">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Mata Pelajaran</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.teachers.index') }}" class="{{ Route::is('admin.teachers.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Guru">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5713 5h7v9h-7m-6.00001-4-3 4.5m3-4.5v5m0-5h3.00001m0 0h5m-5 0v5m-3.00001 0h3.00001m-3.00001 0v5m3.00001-5v5m6-6 2.5 6m-3-6-2.5 6m-3-14.5c0 .82843-.67158 1.5-1.50001 1.5-.82843 0-1.5-.67157-1.5-1.5s.67157-1.5 1.5-1.5 1.50001.67157 1.50001 1.5Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Guru</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.students.index') }}" class="{{ Route::is('admin.students.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Siswa">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.6144 7.19994c.3479.48981.5999 1.15357.5999 1.80006 0 1.6569-1.3432 3-3 3-1.6569 0-3.00004-1.3431-3.00004-3 0-.67539.22319-1.29865.59983-1.80006M6.21426 6v4m0-4 6.00004-3 6 3-6 2-2.40021-.80006M6.21426 6l3.59983 1.19994M6.21426 19.8013v-2.1525c0-1.6825 1.27251-3.3075 2.95093-3.6488l3.04911 2.9345 3-2.9441c1.7026.3193 3 1.9596 3 3.6584v2.1525c0 .6312-.5373 1.1429-1.2 1.1429H7.41426c-.66274 0-1.2-.5117-1.2-1.1429Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Siswa</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.classrooms.index') }}" class="{{ Route::is('admin.classrooms.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Kelas">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 20v-9l-4 1.125V20h4Zm0 0h8m-8 0V6.66667M16 20v-9l4 1.125V20h-4Zm0 0V6.66667M18 8l-6-4-6 4m5 1h2m-2 3h2"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Kelas</span>
                </a>
            </li>
            
            <li class="is-drawer-close:hidden is-drawer-open:menu-title">
                Akademik
            </li>
            <li class="is-drawer-open:hidden is-drawer-close:menu-title">
            </li>

            <li>
                <a href="{{ route('admin.class-assignments.index') }}" class="{{ Route::is('admin.class-assignments.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Registrasi Kelas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" class="intentui-icons size-4" data-slot="icon" aria-hidden="true"><path fill="currentColor" d="M21.75 4.5H15A3.75 3.75 0 0 0 12 6a3.75 3.75 0 0 0-3-1.5H2.25a.75.75 0 0 0-.75.75v13.5a.75.75 0 0 0 .75.75H9a2.25 2.25 0 0 1 2.25 2.25.75.75 0 1 0 1.5 0A2.25 2.25 0 0 1 15 19.5h6.75a.75.75 0 0 0 .75-.75V5.25a.75.75 0 0 0-.75-.75M9 18H3V6h6a2.25 2.25 0 0 1 2.25 2.25v10.5A3.73 3.73 0 0 0 9 18m12 0h-6a3.73 3.73 0 0 0-2.25.75V8.25A2.25 2.25 0 0 1 15 6h6z"></path></svg>
                    <span class="is-drawer-close:hidden">Registrasi Kelas</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.schedules.index') }}" class="{{ Route::is('admin.schedules.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Roster">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 14H4m6.5 3L8 20m5.5-3 2.5 3M4.88889 17H19.1111c.4909 0 .8889-.4157.8889-.9286V4.92857C20 4.41574 19.602 4 19.1111 4H4.88889C4.39797 4 4 4.41574 4 4.92857V16.0714c0 .5129.39797.9286.88889.9286ZM13 14v-3h4v3h-4Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Roster</span>
                </a>
            </li>
            
            
            <li>
                <a href="{{ route('admin.scores.index') }}" class="{{ Route::is('admin.scores.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Monitoring Nilai">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-5-4v4h4V3h-4Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Monitoring Nilai</span>
                </a>
            </li>
            
        </ul>
    </div>
</div>
