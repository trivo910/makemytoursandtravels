<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo
        :title="$title ?? config('app.name', 'Make My Tours & Travels')"
        :description="$description ?? null"
        :canonical="$canonical ?? null"
        :og-title="$ogTitle ?? null"
        :og-description="$ogDescription ?? null"
        :og-image="$ogImage ?? null"
        :og-type="$ogType ?? 'website'"
        :robots="$robots ?? 'index, follow'"
        :schema="$schema ?? null"
        :breadcrumbs="$breadcrumbs ?? []"
    />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="{{ $bodyClass ?? '' }}">
    <a class="skip-link" href="#main-content">Skip to content</a>
    <x-site-header />
    <main id="main-content" class="site-main">
        @yield('content')
    </main>
    <x-site-footer />
    @stack('scripts')
</body>
</html>
