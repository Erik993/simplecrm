<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>main app document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


</head>
<body>
<p>Logged in as: {{ auth()->user()->role }}</p>

@auth
    @include('partials.navbar')
@endauth

<div class="d-flex bg-light" style="padding-top: 56px;">

    @auth
    {{-- Sidebar --}}
        @include('partials.sidebar')
    @endauth

    {{-- Main Content --}}
    <div class="flex-grow-1" style="margin-left: 200px;">
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
