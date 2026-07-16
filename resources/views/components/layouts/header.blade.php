<div class="navbar w-full bg-base-300 shadow-sm">
    
    <label for="sidebar-toggle" aria-label="open sidebar" class="btn btn-square">
        <!-- Sidebar toggle icon -->
        <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7 10 1.99994 1.9999-1.99994 2M12 5v14M5 4h14c.5523 0 1 .44772 1 1v14c0 .5523-.4477 1-1 1H5c-.55228 0-1-.4477-1-1V5c0-.55228.44772-1 1-1Z"/>
        </svg>
    </label>
    
    <div class="flex-1 px-4">
        <h1 class="text-lg font-semibold">Sistem Administrasi PKBM Hanuba</h1>
    </div>
    
    <div class="flex items-center gap-2">
        
        <!-- toggle theme -->
        <label class="swap swap-rotate">
            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" class="theme-controller" onchange="setAppearance(this.checked ? 'dark' : 'light')" />            
            <!-- sun icon -->
            <svg class="swap-on w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
            </svg>
            
            <!-- moon icon -->
            <svg class="swap-off w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 0 1-.5-17.986V3c-.354.966-.5 1.911-.5 3a9 9 0 0 0 9 9c.239 0 .254.018.488 0A9.004 9.004 0 0 1 12 21Z"/>
            </svg>
        </label>
        
        <div role="separator" aria-orientation="vertical" class="w-px h-5 bg-base-content/30"></div>
        
        <x-user-menu />
    </div>
    
</div>