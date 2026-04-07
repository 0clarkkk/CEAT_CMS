<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UPH Engineering') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 via-white to-maroon-50/30 relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-maroon-500/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-maroon-300/30 rounded-full"></div>
            <div class="absolute top-1/3 right-1/3 w-1.5 h-1.5 bg-primary-400/30 rounded-full"></div>
            <div class="absolute bottom-1/4 right-1/4 w-2.5 h-2.5 bg-maroon-200/30 rounded-full"></div>
        </div>

        <!-- Logo -->
        <div class="relative mb-6 animate-fade-in">
            <a href="/" class="flex flex-col items-center gap-3 group">
                <div class="w-16 h-16 bg-gradient-to-br from-maroon-500 to-maroon-700 rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-xl group-hover:shadow-2xl transition-all duration-300 group-hover:scale-105">
                    UPH
                </div>
                <div class="text-center">
                    <span class="block font-bold text-maroon-700 text-lg">UPH Engineering</span>
                    <span class="block text-xs text-gray-400 tracking-wider uppercase">Content Management System</span>
                </div>
            </a>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md px-8 py-8 bg-white/80 backdrop-blur-sm shadow-elevated overflow-hidden sm:rounded-2xl border border-gray-100/50 relative animate-fade-in-up">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-maroon-500 via-primary-500 to-maroon-500"></div>
            {{ $slot }}
        </div>

        <!-- Footer link -->
        <p class="mt-8 text-xs text-gray-400 animate-fade-in animation-delay-300">
            © {{ date('Y') }} University of Perpetual Help System DALTA
        </p>
    </div>
</body>
</html>
