@props([
    'title',
    'description' => null,
    'canonical' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'robots' => 'index, follow',
    'schema' => null,
    'breadcrumbs' => [],
])

@php
    $canonicalUrl = $canonical ?: config('site.canonical_url') . request()->getPathInfo();
    $canonicalPath = parse_url($canonicalUrl, PHP_URL_PATH) ?: '/';

    if (($canonicalPath === '/' && !str_ends_with($canonicalUrl, '/')) || !str_ends_with($canonicalPath, '/')) {
        $canonicalUrl .= '/';
    }
    $ogImageUrl = $ogImage ?: config('site.canonical_url') . '/images/mumbai-bus-travel-hero.jpg';
@endphp

<title>{{ $title }}</title>
@if ($description)
    <meta name="description" content="{{ $description }}">
@endif
<meta name="robots" content="{{ $robots }}">
<meta name="googlebot" content="{{ $robots }}">
@if ($canonicalUrl)
    <link rel="canonical" href="{{ $canonicalUrl }}">
@endif
<meta property="og:site_name" content="Make My Tours &amp; Travels">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $ogTitle ?: $title }}">
<meta property="og:description" content="{{ $ogDescription ?: $description }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImageUrl }}">
<meta property="og:image:alt" content="{{ $ogTitle ?: $title }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $ogTitle ?: $title }}">
<meta name="twitter:description" content="{{ $ogDescription ?: $description }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">
@if ($schema)
    <script type="application/ld+json">{!! \Illuminate\Support\Js::encode($schema) !!}</script>
@endif
@if (count($breadcrumbs) > 1)
    <script type="application/ld+json">{!!
        \Illuminate\Support\Js::encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(
                fn (array $item, int $index): array => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['label'],
                    'item' => isset($item['url'])
                        ? (str_starts_with($item['url'], 'http')
                            ? $item['url']
                            : config('site.canonical_url') . '/' . ltrim($item['url'], '/'))
                        : $canonicalUrl,
                ],
                $breadcrumbs,
                array_keys($breadcrumbs),
            ),
        ])
    !!}</script>
@endif
