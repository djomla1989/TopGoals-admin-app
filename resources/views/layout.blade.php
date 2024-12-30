<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">My Laravel App</h1>
    </div>
</header>
<main class="container mx-auto mt-6">
    @yield('content')
</main>
<footer class="bg-gray-800 text-white py-4 mt-6">
    <div class="container mx-auto text-center">
        &copy; {{ date('Y') }} My Laravel App. All rights reserved.
    </div>
</footer>
</body>
</html>
