@props(['title', 'description', 'href' => null, 'number' => null, 'icon' => false])

<x-card class="service-card">
    @if ($icon)
        <span class="service-card__icon" aria-hidden="true">
            <svg viewBox="0 0 32 32" focusable="false"><path d="M5 20V11l3-5h16l3 5v9m-22 0h22m-18 0v5m14-5v5M8 11h16m-17 9h18M10 25h12" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" /></svg>
        </span>
    @elseif ($number)
        <span class="service-card__number" aria-hidden="true">{{ $number }}</span>
    @endif
    <h3 class="card__title">{{ $title }}</h3>
    <p>{{ $description }}</p>
    @if ($href)
        <a class="text-link" href="{{ $href }}">Learn more<span class="visually-hidden"> about {{ $title }}</span></a>
    @endif
</x-card>
