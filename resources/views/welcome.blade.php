@extends('layouts.app', [
    'bodyClass' => 'home-page',
    'title' => 'Bus Hire & Tempo Traveller Rental in Mumbai | Make My Tours & Travels',
    'description' => 'Make My Tours & Travels provides bus hire and Tempo Traveller hire for journeys planned from Mumbai. Send your route and travel date to enquire.',
    'canonical' => config('site.canonical_url') . '/',
    'ogTitle' => 'Bus Hire & Tempo Traveller Rental in Mumbai',
    'ogImage' => config('site.canonical_url') . '/images/mumbai-bus-travel-hero.jpg',
    'schema' => [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => config('site.canonical_url') . '/#organization',
                'name' => 'Make My Tours & Travels',
                'url' => config('site.canonical_url') . '/',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => config('site.canonical_url') . '/images/make-my-tours-logo.png',
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => config('site.canonical_url') . '/#website',
                'url' => config('site.canonical_url') . '/',
                'name' => 'Make My Tours & Travels',
                'publisher' => ['@id' => config('site.canonical_url') . '/#organization'],
                'inLanguage' => 'en-IN',
            ],
        ],
    ],
])

@php
    $services = [
        ['title' => 'Wedding Guests', 'description' => 'Enquire about group transport for wedding guests. Share your route, date and group size to discuss availability.', 'number' => '01'],
        ['title' => 'Corporate Travelers', 'description' => 'Ask about transport for business meetings, corporate events and employee journeys.', 'number' => '02'],
        ['title' => 'Private Travelers', 'description' => 'Discuss bus or Tempo Traveller options for a private family or group journey.', 'number' => '03'],
        ['title' => 'Airport Shuttles', 'description' => 'Enquire about airport pickup or drop-off transport for your group and travel date.', 'number' => '04'],
        ['title' => 'Tours & Excursions', 'description' => 'Plan group transport for a tour or excursion and confirm the route with the team.', 'number' => '05'],
        ['title' => 'Budget Car Rental', 'description' => 'Contact the team to confirm whether car rental is currently available for your trip.', 'number' => '06'],
    ];

    $fleet = [
        ['title' => 'AC Bus', 'price' => '₹00', 'rateUnit' => '/day', 'specifications' => ['50 Seat', '2 Driver Staff', 'Manual', 'Fully Insured'], 'image' => asset('images/luxury-ac-coach.jpg'), 'imageAlt' => 'AC bus shown for group travel', 'href' => '/bus-hire/'],
        ['title' => 'Non-AC Bus', 'price' => '₹00', 'rateUnit' => '/day', 'specifications' => ['42 Seat', '2 Driver Staff', 'Manual', 'Fully Insured'], 'image' => asset('images/non-ac-bus.jpg'), 'imageAlt' => 'Non-AC bus shown for group travel', 'href' => '/bus-hire/'],
        ['title' => 'Tempo', 'price' => '₹00', 'rateUnit' => '/day', 'specifications' => ['12 Seat', '1 Driver Staff', 'Manual', 'Fully Insured'], 'image' => asset('images/tempo-traveller.jpg'), 'imageAlt' => 'Tempo Traveller shown near the Gateway of India in Mumbai', 'href' => '/tempo-traveller-hire/'],
    ];

    $testimonials = [
        ['name' => 'Dhanesh Panchal', 'image' => asset('images/testimonial-dhanesh-panchal.jpg')],
        ['name' => 'Priya Mehta', 'image' => asset('images/testimonial-priya-mehta.jpg')],
        ['name' => 'Rahul Sharma', 'image' => asset('images/testimonial-rahul-sharma.jpg')],
        ['name' => 'Purnima Thakur', 'image' => asset('images/testimonial-purnima-thakur.jpg')],
    ];
@endphp

@section('content')
    <section class="home-hero" aria-labelledby="home-title">
        <img class="home-hero__image" src="{{ asset('images/mumbai-bus-travel-hero.jpg') }}" alt="" width="1600" height="842" fetchpriority="high">
        <div class="home-hero__shade" aria-hidden="true"></div>
        <div class="container home-hero__content">
            <!-- <p class="home-eyebrow">Make My Tours &amp; Travels · Since 2008</p> -->
            <h1 id="home-title">Make My Tours &amp; Travels
Your Trusted Travel Partner Since 2008</span></h1>
            <p class="home-hero__intro">Welcome to Mumbai Explorations, where we strive to provide our guests with a richer, more nuanced understanding of the vibrant city of Mumbai through our thoughtfully curated day tours.</p>
            <div class="home-hero__actions">
                <x-button href="#booking-form" class="button--hero">Get Started</x-button>
                <a class="hero-video-link" href="https://www.youtube.com/watch?v=M-pv0QDkhHc" target="_blank" rel="noopener noreferrer">
                    <span class="hero-video-link__play" aria-hidden="true">
                        <svg viewBox="0 0 20 20" focusable="false"><path d="m7 4 9 6-9 6z" fill="currentColor" /></svg>
                    </span>
                    <span>Play Video</span>
                </a>
            </div>
        </div>
    </section>

    <x-booking-form />

    <section class="home-about home-section" aria-labelledby="about-title">
        <div class="container home-about__grid">
            <div class="home-about__copy">
                <p class="home-section-heading__eyebrow">About Company</p>
                <h2 id="about-title">Welcome to <span>Make My Tours &amp; Travels</span></h2>
                <p>We strive to provide our guests with a richer understanding of Mumbai through thoughtfully curated tours. Our offerings bring together well-known landmarks and lesser-known places, helping visitors discover the city’s culture and history.</p>
                <x-button href="/about/" variant="primary">More About Us</x-button>
            </div>
            <div class="home-about__visual" role="group" aria-label="Mumbai travel and bus images">
                <span class="home-about__shape" aria-hidden="true"></span>
                <img class="home-about__primary" src="{{ asset('images/mumbai-tours-about-primary.png') }}" alt="Tour bus and visitors near the Gateway of India in Mumbai" width="1096" height="1435" loading="lazy">
                <img class="home-about__inset" src="{{ asset('images/mumbai-tours-about-mobile.jpg') }}" alt="Visitor enjoying the Mumbai waterfront from a tour bus" width="1127" height="1396" loading="lazy">
                <div class="experience-badge">
                    <span class="experience-badge__icon" aria-hidden="true">
                        <svg viewBox="0 0 32 32" focusable="false"><path d="M16 3.5 20 6l4.7-.1.8 4.6 3 3.6-2.1 4.2.6 4.6-4.3 1.9-2.9 3.7-4.5-1.1-4.5 1.1-2.9-3.7-4.3-1.9.6-4.6-2.1-4.2 3-3.6.8-4.6L12 6z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" /><path d="m11.5 16 3 3 6-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" /></svg>
                    </span>
                    <span class="experience-badge__copy"><strong>15<sup>+</sup></strong><span>Years Experience</span></span>
                </div>
            </div>
        </div>
    </section>

    <section class="home-trust home-section" aria-labelledby="trust-title">
        <div class="home-trust__grid">
            <div class="home-trust__visual">
                <img src="{{ asset('images/make-my-why-choose-us.png') }}" alt="Family standing beside a Make My Tours &amp; Travels coach near the Gateway of India" width="1536" height="1024" loading="lazy">
                <div class="home-trust__cta">
                    <h3>Travel with Make My Tours &amp; Travels</h3>
                    <p>Experience comfortable, reliable, and affordable tours with our dedicated team, ensuring every journey is smooth, enjoyable, and memorable from start to finish.</p>
                    <a href="#booking-form">Book Your Tour <span aria-hidden="true">→</span></a>
                </div>
            </div>
            <div class="home-trust__panel">
                <p class="home-trust__eyebrow">Why Choose Us</p>
                <h2 id="trust-title">Make My Tours &amp; Travels – <span>Trusted</span> Since 2008</h2>
                <p class="home-trust__description">Make My Tours &amp; Travels offers comfortable journeys with well-maintained buses, experienced drivers, affordable fares, and carefully planned tours, ensuring every trip is safe, convenient, and memorable.</p>
                <div class="home-stats" aria-label="Make My Tours &amp; Travels">
                    <x-stat-card value="15" label="Years of Experience" icon="bus" suffix="+" />
                    <x-stat-card value="5,000" label="Happy Travelers" icon="travellers" suffix="+" />
                    <x-stat-card value="1,000" label="Successful Tours" icon="achievement" suffix="+" />
                    <x-stat-card value="8,000" label="Customer Satisfaction" icon="satisfaction" suffix="+" />
                </div>
            </div>
        </div>
    </section>

    <section class="home-services home-section" id="services" aria-labelledby="services-title">
        <div class="container">
            <x-home-section-heading
                eyebrow="Our Services"
                title="Explore Our Travel Services"
                description="The live website lists travel services for wedding guests, corporate and private travellers, airport shuttles, tours and excursions, and car rental. Contact the team to confirm current availability."
                id="services-title"
            />
            <div class="home-service-grid">
                @foreach ($services as $service)
                    <x-service-card
                        :title="$service['title']"
                        :description="$service['description']"
                        icon
                        href="/contact/"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section
        class="journey-cta"
        aria-labelledby="journey-title"
        style="--journey-cta-background: url('{{ asset('images/traveling-by-bus-interior.webp') }}')"
    >
        <div class="container">
            <div class="journey-cta__panel">
                <img class="journey-cta__image" src="{{ asset('images/book-your-mumbai-journey.jpg') }}" alt="Mobile travel booking and Mumbai journey ticket screens" width="1024" height="1536" loading="lazy">
                <div class="journey-cta__copy">
                    <p class="home-eyebrow">Book Your Journey Today</p>
                    <h2 id="journey-title">Travel Comfortably with Make My <span>Tours</span> &amp; Travels</h2>
                    <p>Whether you’re planning a family trip, corporate travel, airport transfer, or a sightseeing tour, Make My Tours &amp; Travels is ready to provide safe, comfortable, and hassle-free transportation. With well-maintained vehicles, experienced drivers, affordable pricing, and a strong commitment to customer satisfaction, we ensure every journey is smooth, reliable, and memorable. From booking to your final destination, our team is dedicated to delivering a travel experience you can trust and enjoy.</p>
                    <x-button href="tel:+917718036300" variant="primary">Book Now</x-button>
                </div>
            </div>
        </div>
    </section>

    <section class="home-fleet home-section" id="fleet" aria-labelledby="fleet-title">
        <div class="container">
            <div class="home-fleet__header">
                <div class="home-fleet__title">
                    <p class="home-section-heading__eyebrow">Our Bus</p>
                    <h2 id="fleet-title">Our Bus Collection</h2>
                </div>
                <p class="home-fleet__description">Choose from our collection of buses and Tempo Travellers for your next journey. Contact us to confirm availability, vehicle details and pricing for your travel date.</p>
                <x-button href="/bus-hire/" variant="primary" class="home-fleet__all-button">All Vehicle</x-button>
            </div>
            <div class="home-fleet-grid">
                @foreach ($fleet as $vehicle)
                    <x-fleet-card
                        :title="$vehicle['title']"
                        :price="$vehicle['price']"
                        :rate-unit="$vehicle['rateUnit']"
                        :specifications="$vehicle['specifications']"
                        :image="$vehicle['image']"
                        :image-alt="$vehicle['imageAlt']"
                        :href="$vehicle['href']"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="home-testimonials home-section" aria-labelledby="testimonials-title">
        <img class="home-testimonials__background" src="{{ asset('images/mumbai-bus-travel-hero.jpg') }}" alt="" width="1600" height="842" loading="lazy">
        <div class="container">
            <x-home-section-heading
                eyebrow="Our Customers"
                title="Customers Featured on Our Website"
                description="Customer names and portraits featured on the original website."
                id="testimonials-title"
            />
            <div class="home-testimonial-grid">
                @foreach ($testimonials as $testimonial)
                    <x-testimonial-card
                        :quote="$testimonial['quote'] ?? null"
                        :name="$testimonial['name']"
                        :image="$testimonial['image']"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="home-blog home-section" aria-labelledby="blog-title">
        <div class="container">
            <div class="home-blog__heading">
                <x-home-section-heading
                    eyebrow="Our Bus"
                    title="Latest Articles & Blog"
                    id="blog-title"
                    align="left"
                />
                <x-button href="/hello-world/" variant="secondary">Read Travel Guide</x-button>
            </div>
            <div class="home-blog__empty">
                <img class="home-blog__image" src="{{ asset('images/mumbai-tours-about-mobile.jpg') }}" alt="Mumbai waterfront seen from a tour bus" width="1127" height="1396" loading="lazy">
                <div>
                    <h3><a href="/hello-world/">Planning a Mumbai sightseeing day trip by bus</a></h3>
                    <p>Practical tips for choosing stops, planning group transport and keeping a Mumbai sightseeing day flexible.</p>
                </div>
                <a class="text-link" href="/hello-world/">Read the guide<span class="visually-hidden">: Planning a Mumbai sightseeing day trip by bus</span></a>
            </div>
        </div>
    </section>
@endsection
