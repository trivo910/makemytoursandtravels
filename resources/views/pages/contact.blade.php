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

    <article class="contact-page">
        <header class="contact-page__intro container">
            <p class="content-page__eyebrow">Contact Us</p>
            <h1>Let’s plan your next journey</h1>
            <p>Contact Make My Tours &amp; Travels to discuss bus, Tempo Traveller or Urbania availability, your route and a trip-specific quote.</p>
        </header>

        <div class="container contact-page__grid">
            <section class="contact-card contact-card--primary" aria-labelledby="contact-phone-heading">
                <span class="contact-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false"><path d="M6.6 3.8h3l1.5 4.1-1.9 1.5a15.2 15.2 0 0 0 5.4 5.4l1.5-1.9 4.1 1.5v3c0 .9-.7 1.6-1.6 1.6C10.6 19 5 13.4 5 6.4c0-.9.7-1.6 1.6-1.6Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" /></svg>
                </span>
                <h2 id="contact-phone-heading">Call the team</h2>
                <p>Discuss your pickup, destination, travel date and passenger count.</p>
                <a class="contact-card__value" href="{{ $phoneLink }}">{{ $phone }}</a>
            </section>

            <section class="contact-card" aria-labelledby="contact-email-heading">
                <span class="contact-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false"><path d="M4 6h16v12H4zM4.5 7l7.5 6 7.5-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" /></svg>
                </span>
                <h2 id="contact-email-heading">Send an email</h2>
                <p>Share your trip details or ask a question about a vehicle.</p>
                <a class="contact-card__value contact-card__value--email" href="mailto:{{ $email }}">{{ $email }}</a>
            </section>

            <section class="contact-card" aria-labelledby="contact-address-heading">
                <span class="contact-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false"><path d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" /><circle cx="12" cy="10" r="2.2" fill="none" stroke="currentColor" stroke-width="1.7" /></svg>
                </span>
                <h2 id="contact-address-heading">Mumbai office</h2>
                <address>{{ $address }}</address>
                <a class="text-link" href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer">View on Google Maps</a>
            </section>
        </div>

        <section class="contact-page__next container" aria-labelledby="contact-next-heading">
            <div>
                <p class="content-page__eyebrow">Ready to enquire?</p>
                <h2 id="contact-next-heading">Send your trip details</h2>
                <p>Include a pickup location, destination, date, start time and passenger count so the team can check options with you.</p>
            </div>
            <x-button href="/#booking-form" variant="primary">Start a Trip Enquiry</x-button>
        </section>
    </article>
@endsection
