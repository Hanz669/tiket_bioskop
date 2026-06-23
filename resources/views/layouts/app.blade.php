<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tiket Bioskop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('tikets.index') }}" class="text-white text-xl font-bold tracking-wider">🍿 TIX BIOSKOP</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('movies.index') }}" class="text-indigo-100 hover:text-white px-3 py-2 rounded-md font-medium transition">Kelola Film</a>
                    <a href="{{ route('tikets.index') }}" class="text-indigo-100 hover:text-white px-3 py-2 rounded-md font-medium transition">Daftar Tiket</a>
                    <a href="{{ route('tikets.scanner') }}" target="_blank" class="bg-white text-indigo-600 hover:bg-gray-100 px-4 py-2 rounded-md font-bold shadow-sm transition">📷 Scanner</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>