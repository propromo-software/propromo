<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="relative min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
        <header class="sticky top-0 z-50">
            @if(request()->path() !== '/' && request()->path() !== 'create-monitor' && request()->path() !== 'create-open-source-monitor' && request()->path() !== 'register' && request()->path() !== 'login' && request()->path() !== 'join')
                @include('components.layouts.navigation-logged-in')
            @else
                @include('components.layouts.navigation-logged-out')
            @endif
        </header>

        <main class="px-8 pb-4 min-h-screen">
            @if(request()->path() !== '/' && 
                request()->path() !== 'create-monitor' && 
                request()->path() !== 'create-open-source-monitor' && 
                request()->path() !== 'register' && 
                request()->path() !== 'login' && 
                request()->path() !== 'join' &&
                request()->path() !== 'settings/profile' &&
                request()->route()->getName() !== 'monitors.show')
                <div class="container px-8 py-4 mx-auto">
                    <x-breadcrumbs 
                        route="{{ request()->route()->getName() }}" 
                        location="top"
                        :params="request()->route()->parameters()" 
                    />
                </div>
            @endif

            @yield('content')
            {{ $slot }}

            <livewire:base.api-changed-toast></livewire:base.api-changed-toast>
        </main>

        @if(request()->path() === '/' || 
            request()->path() === 'create-monitor' || 
            request()->path() === 'create-open-source-monitor' || 
            request()->path() === 'register' || 
            request()->path() === 'login' || 
            request()->path() === 'join')
            <x-footer :route="request()->route()->getName()" />
        @endif
    </body>
</html>
