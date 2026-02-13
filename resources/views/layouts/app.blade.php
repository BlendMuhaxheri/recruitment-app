<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-900">

    <div class="min-h-screen flex">

        {{-- Sidebar Component --}}
        <x-layout.sidebar />

        <div class="flex-1 lg:ml-72">

            {{-- Topbar Component --}}
            <x-layout.topbar
                :pageTitle="$pageTitle ?? 'Dashboard'"
                :pageSubtitle="$pageSubtitle ?? ''" />

            <main class="p-6">
                @yield('content')
            </main>


        </div>

    </div>

</body>

</html>