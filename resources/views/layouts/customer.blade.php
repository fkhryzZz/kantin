<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Multi-Tenant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black min-h-screen p-4 flex flex-col justify-between">

    <div>
        <!-- Baris Kantin Header -->
        <div class="bg-zinc-800 p-3 rounded-md mb-4 font-semibold text-sm">
            Kantin: {{ $canteen }}
        </div>

        <!-- Kartu Utama -->
        <div class="border border-zinc-700 p-8 rounded-lg text-center bg-zinc-800/50 my-auto">
            <h2 class="text-lg font-bold mb-2">Katalog belum tersedia</h2>
            <p class="text-zinc-400 text-sm">
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center text-xs text-zinc-500 py-4">
        Kantin Multi-Tenant
    </div>

</body>
</html>