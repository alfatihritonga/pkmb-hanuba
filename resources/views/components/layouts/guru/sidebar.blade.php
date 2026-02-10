<div class="drawer-side is-drawer-close:overflow-visible">
    <label for="sidebar-toggle" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
        <!-- Sidebar content here -->
        <ul class="menu w-full grow">
            
            <li>
                <a href="{{ route('guru.dashboard') }}" class="{{ Route::is('guru.dashboard') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Dashboard">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Dashboard</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('guru.classes.index') }}" class="{{ Route::is('guru.classes.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Kelas">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 14H4m6.5 3L8 20m5.5-3 2.5 3M4.88889 17H19.1111c.4909 0 .8889-.4157.8889-.9286V4.92857C20 4.41574 19.602 4 19.1111 4H4.88889C4.39797 4 4 4.41574 4 4.92857V16.0714c0 .5129.39797.9286.88889.9286ZM13 14v-3h4v3h-4Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Kelas</span>
                </a>
            </li>
            
            {{-- <li>
                <a href="{{ route('guru.scores.recap') }}" class="{{ Route::is('guru.scores.*') ? 'menu-active' : '' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Nilai">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-5-4v4h4V3h-4Z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Nilai</span>
                </a>
            </li> --}}

        </ul>
    </div>
</div>
