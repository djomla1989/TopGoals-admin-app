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
    @yield('scripts')
    <div class="container mx-auto text-center">
        &copy; {{ date('Y') }} My Laravel App. All rights reserved.
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.searchable-select').select2({
                width: 'resolve',
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Select an option'
                }
            });
        });
    </script>
    <style>
        .select2-container--default .select2-results>.select2-results__options{
            max-height: 700px !important;
        }
    </style>
</footer>
</body>
</html>
