@props(['title', 'excerpt', 'href', 'image' => null, 'imageAlt' => ''])

<article {{ $attributes->class('card article-card') }}>
    @if ($image)
        <img class="article-card__image" src="{{ $image }}" alt="{{ $imageAlt }}" loading="lazy">
    @endif
    <div class="article-card__body">
        <h3 class="card__title"><a href="{{ $href }}">{{ $title }}</a></h3>
        <p>{{ $excerpt }}</p>
        <a class="text-link" href="{{ $href }}">Read article<span class="visually-hidden">: {{ $title }}</span></a>
    </div>
</article>
