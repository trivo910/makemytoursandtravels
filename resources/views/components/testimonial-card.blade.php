@props(['quote' => null, 'name', 'context' => null, 'image' => null])

<figure {{ $attributes->class('card testimonial-card') }}>
    @if ($quote)
        <blockquote class="testimonial-card__quote">{{ $quote }}</blockquote>
    @endif
    <figcaption class="testimonial-card__byline">
        @if ($image)
            <img src="{{ $image }}" alt="" width="60" height="60" loading="lazy">
        @endif
        <span class="testimonial-card__identity">
            <strong>{{ $name }}</strong>
            @if ($context)
                <span>{{ $context }}</span>
            @endif
        </span>
    </figcaption>
</figure>
