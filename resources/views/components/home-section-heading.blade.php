@props([
    'eyebrow',
    'title',
    'description' => null,
    'id',
    'align' => 'center',
])

<div {{ $attributes->class(['home-section-heading', 'home-section-heading--left' => $align === 'left']) }}>
    <p class="home-section-heading__eyebrow">{{ $eyebrow }}</p>
    <h2 id="{{ $id }}">{{ $title }}</h2>
    @if ($description)
        <p class="home-section-heading__description">{{ $description }}</p>
    @endif
</div>
