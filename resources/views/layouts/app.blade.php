<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Site')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Inclusion du Header -->
    @include('partials.navbar')

    <main class="container mx-auto mt-10 px-4">
        @yield('content')
    </main>

    <!-- Inclusion du Footer -->
    @include('partials.footer')

</body>
</html>
