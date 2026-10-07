@extends('layouts.app', [
    'title' => $title,
    'description' => $description,
    'canonical' => $canonical,
    'ogTitle' => $ogTitle,
    'ogDescription' => $description,
    'ogImage' => $ogImage,
    'schema' => $schema,
    'breadcrumbs' => $breadcrumbs,
])

@section('content')
    <x-breadcrumbs :items="$breadcrumbs" />

    <article class="faq-page">
        <header class="faq-page__intro container">
            <p class="content-page__eyebrow">Travel Information</p>
            <h1>Bus &amp; Traveller Hire FAQs</h1>
            <p>Practical answers to help you prepare a bus, Tempo Traveller or Urbania enquiry. Confirm vehicle availability, trip terms and quotes with the team for your dates.</p>
        </header>

        <div class="faq-list container">
            @foreach ($faqs as $faq)
                <section class="faq-item" aria-labelledby="faq-question-{{ $loop->index }}">
                    <h2 id="faq-question-{{ $loop->index }}">{{ $faq['question'] }}</h2>
                    <p>{{ $faq['answer'] }}</p>
                </section>
            @endforeach
        </div>

        <section class="faq-page__cta">
            <div class="container faq-page__cta-inner">
                <div>
                    <p class="content-page__eyebrow">Still have a question?</p>
                    <h2>Tell us about your journey</h2>
                    <p>Call us or share your trip details so we can confirm current vehicle availability and terms.</p>
                </div>
                <x-button href="/contact/" variant="secondary" class="button--light">Contact the Team</x-button>
            </div>
        </section>
    </article>
@endsection
