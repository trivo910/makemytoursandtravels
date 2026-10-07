@extends('layouts.app', [
    'title' => $page['title'],
    'description' => $page['description'],
    'canonical' => $page['canonical'],
    'ogTitle' => $page['ogTitle'],
    'ogDescription' => $page['description'],
    'ogImage' => $page['ogImage'],
    'schema' => $page['schema'],
    'breadcrumbs' => $page['breadcrumbs'],
])

@section('content')
    <x-breadcrumbs :items="$page['breadcrumbs']" />

    <article class="content-page">
        <header class="content-page__hero container {{ empty($page['image']) ? 'content-page__hero--text-only' : '' }}">
            <div class="content-page__intro">
                <p class="content-page__eyebrow">{{ $page['eyebrow'] }}</p>
                <h1>{{ $page['heading'] }}</h1>
                <p class="content-page__lead">{{ $page['lead'] }}</p>
                <div class="content-page__actions">
                    <x-button href="/contact/" variant="primary">Ask About Your Trip</x-button>
                    <a class="text-link" href="tel:+917718036300">Call +91 77180 36300</a>
                </div>
            </div>
            @if (!empty($page['image']))
                <div class="content-page__visual">
                    <img
                        src="{{ asset('images/' . $page['image']) }}"
                        alt="{{ $page['imageAlt'] }}"
                        width="{{ $page['imageWidth'] }}"
                        height="{{ $page['imageHeight'] }}"
                        fetchpriority="high"
                    >
                </div>
            @endif
        </header>

        <div class="content-page__sections container">
            @foreach ($page['sections'] as $section)
                <section class="content-page__section" aria-labelledby="content-section-{{ $loop->index }}">
                    <div>
                        <p class="content-page__section-index">0{{ $loop->iteration }}</p>
                    </div>
                    <div class="content-page__section-copy">
                        <h2 id="content-section-{{ $loop->index }}">{{ $section['heading'] }}</h2>
                        @foreach ($section['paragraphs'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        @if (!empty($page['related']))
            <section class="content-page__related home-section" aria-labelledby="related-title">
                <div class="container">
                    <x-home-section-heading
                        eyebrow="Explore More"
                        title="Plan the right journey for your group"
                        id="related-title"
                    />
                    <div class="content-page__related-grid">
                        @foreach ($page['related'] as $related)
                            <x-service-card
                                :title="$related['title']"
                                :description="$related['description']"
                                :href="$related['href']"
                            />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
@endsection
