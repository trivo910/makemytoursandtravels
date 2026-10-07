@props(['title' => null])

<article {{ $attributes->class('card') }}>
    @if ($title)
        <h3 class="card__title">{{ $title }}</h3>
    @endif
    <div class="card__content">{{ $slot }}</div>
</article>
