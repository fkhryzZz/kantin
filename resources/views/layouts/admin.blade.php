<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-50 text-zinc-900 min-h-screen">
    <header class="bg-white border-b border-zinc-200 px-6 py-4 flex justify-between items-center">
        <h1 class="font-bold text-xl">Admin Kantin</h1>
        <span class="text-sm text-zinc-500">Superadmin</span>
    </header>
    <main class="p-6">
        {{ $slot ?? '' }}
    </main>
</body>
</html>