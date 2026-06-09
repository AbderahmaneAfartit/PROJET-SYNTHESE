@props(['title' => 'Freelance-Job'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body data-route="{{ request()->route()?->getName() }}" data-bs-spy="scroll" data-bs-target="#site-navbar" data-bs-offset="100">
    <div class="global-grid-overlay"></div>
    <x-site.navbar />
    {{ $slot }}
    <x-site.footer />
</body>
</html>
