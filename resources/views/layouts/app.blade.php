<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }} - Poliklinik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 min-h-screen">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <div id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 -translate-x-full lg:translate-x-0 lg:static transition-transform">
            @include('components.partials.sidebar')
        </div>
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden"></div>

        {{-- Konten --}}
        <div class="flex-1 flex flex-col min-w-0">
            @include('components.partials.header')

            <main class="flex-1 p-6">
                @yield('content')
            </main>

            @include('components.partials.footer')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('overlay').classList.toggle('hidden');
        }
    </script>
</body>
</html>
