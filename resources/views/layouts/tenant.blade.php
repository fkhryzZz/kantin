<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Tenant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-100 text-zinc-800 min-h-screen flex">
    <aside class="w-64 bg-white border-r border-zinc-200 p-4">
        <h1 class="font-bold text-lg mb-6">Portal Tenant</h1>
        <nav class="space-y-2">
            <a href="#" class="block px-3 py-2 rounded bg-zinc-100 font-medium">Dashboard</a>
            <a href="#" class="block px-3 py-2 rounded text-zinc-600 hover:bg-zinc-50">Katalog Menu</a>
            <a href="#" class="block px-3 py-2 rounded text-zinc-600 hover:bg-zinc-50">Pesanan (KDS)</a>
        </nav>
    </aside>
    <main class="flex-1 p-6">
        {{ $slot ?? '' }}
    </main>
</body>
</html>