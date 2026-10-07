@props([
    'title',
    'price',
    'rateUnit' => '/day',
    'specifications' => [],
    'image' => null,
    'imageAlt' => '',
    'href' => null,
])

<article {{ $attributes->class('card fleet-card') }}>
    @if ($image)
        <img class="fleet-card__image" src="{{ $image }}" alt="{{ $imageAlt }}" width="1525" height="1031" loading="lazy">
    @endif
    <div class="fleet-card__panel">
        <div class="fleet-card__heading">
            <h3 class="card__title">{{ $title }}</h3>
            <p class="fleet-card__price" aria-label="{{ $price }} {{ $rateUnit }} reference display; confirm current pricing"><span>{{ $price }}</span><small>{{ $rateUnit }}</small></p>
        </div>
        <ul class="fleet-card__specifications" aria-label="{{ $title }} specifications">
            @foreach ($specifications as $specification)
                <li>
                    <svg viewBox="0 0 20 20" aria-hidden="true" focusable="false"><path d="M10 2.5 12 7l4.8.5-3.6 3.2 1 4.8L10 13l-4.2 2.5 1-4.8-3.6-3.2L8 7z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" /></svg>
                    <span>{{ $specification }}</span>
                </li>
            @endforeach
        </ul>
        <div class="fleet-card__actions">
            <a class="fleet-card__book button button--primary" href="#booking-form">Book Now<span class="visually-hidden">: {{ $title }}</span></a>
            @if ($href)
                <a class="fleet-card__details" href="{{ $href }}">View Details<span aria-hidden="true">→</span><span class="visually-hidden">: {{ $title }}</span></a>
            @endif
        </div>
    </div>
</article>
