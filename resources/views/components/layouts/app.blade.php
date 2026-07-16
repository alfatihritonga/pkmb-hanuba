<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    
    <script>
        (function () {
            const THEMES = {
                light: 'winter',
                dark: 'night',
            }
            
            function applyTheme(theme) {
                document.documentElement.setAttribute(
                'data-theme',
                THEMES[theme] ?? THEMES.light
                )
            }
            
            function getSystemTheme() {
                return window.matchMedia('(prefers-color-scheme: dark)').matches
                ? 'dark'
                : 'light'
            }
            
            window.setAppearance = function (appearance) {
                if (appearance === 'system') {
                    localStorage.removeItem('appearance')
                    applyTheme(getSystemTheme())
                } else {
                    localStorage.setItem('appearance', appearance)
                    applyTheme(appearance)
                }
                
                updateToggle(appearance)
            }
            
            function updateToggle(appearance) {
                const checkbox = document.querySelector('.theme-controller')
                if (!checkbox) return
                
                checkbox.checked =
                (appearance === 'dark') ||
                (appearance === 'system' && getSystemTheme() === 'dark')
            }
            
            // init
            const saved = localStorage.getItem('appearance') || 'system'
            applyTheme(saved === 'system' ? getSystemTheme() : saved)
            
            document.addEventListener('DOMContentLoaded', () => {
                updateToggle(saved)
            })
        })()
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content">
    
    <div class="drawer lg:drawer-open">
        
        <input id="sidebar-toggle" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content">
            
            <x-layouts.header />
            
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
        
        <!-- Sidebar -->
        @if (auth()->user()->hasRole('admin'))
            <x-layouts.admin.sidebar />
        @else
            <x-layouts.guru.sidebar />
        @endif
    </div>
    
</body>
</html>
