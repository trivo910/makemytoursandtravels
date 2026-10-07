@extends('layouts.app', [
    'title' => $title,
    'description' => $description,
    'canonical' => $canonical,
    'ogTitle' => $ogTitle,
    'ogDescription' => $description,
    'ogImage' => $ogImage,
    'ogType' => 'article',
    'schema' => $schema,
    'breadcrumbs' => $breadcrumbs,
])

@section('content')
    <x-breadcrumbs :items="$breadcrumbs" />

    <article class="article-page">
        <header class="article-page__hero">
            <div class="container article-page__hero-inner">
                <p class="content-page__eyebrow">Mumbai Travel Guide</p>
                <h1>Planning a Mumbai sightseeing day trip by bus</h1>
                <p>Build a relaxed group itinerary around the places you most want to see, while leaving room for city traffic, breaks and changes along the way.</p>
                <p class="article-page__byline">By Make My Tours &amp; Travels <span aria-hidden="true">·</span> <time datetime="2026-10-02">2 October 2026</time></p>
                <img src="{{ asset('images/mumbai-bus-travel-hero.jpg') }}" alt="Group buses ready for a Mumbai sightseeing trip" width="1600" height="842" fetchpriority="high">
            </div>
        </header>

        <div class="container article-page__layout">
            <div class="article-content">
                <p class="article-content__intro">Mumbai rewards a little planning. Landmarks, markets, waterfronts and neighbourhoods each have their own pace, and the time it takes to move between them can change with traffic. For a family, school or other group, agreeing on a flexible route before travel can make the day easier to enjoy.</p>

                <section aria-labelledby="guide-route">
                    <h2 id="guide-route">Choose a few places, not a packed checklist</h2>
                    <p>Start by asking what the group wants from the day: famous architecture, local history, a waterfront stop, food, or a mixture. Select a manageable set of places and leave space between stops. A shorter plan gives the group time to look around rather than treating every landmark as a quick photograph.</p>
                    <p>For a South Mumbai-focused outing, the Gateway of India and Chhatrapati Shivaji Maharaj Terminus (CST) are familiar reference points. Sassoon Dock and the Bombay Panjrapole are other places mentioned in the company’s Mumbai tour information. Check current access arrangements and visiting information directly with each destination before setting the route.</p>
                </section>

                <section aria-labelledby="guide-group">
                    <h2 id="guide-group">Plan around the group travelling with you</h2>
                    <p>Think about who is joining, how long the outing should feel, how much luggage people will carry and whether anyone needs extra time to board or move between stops. Families, students, colleagues and wedding guests can have different requirements even when travelling to the same place.</p>
                    <p>If you are arranging group transport, confirm the passenger count and luggage needs with the provider before choosing a vehicle. Make My Tours &amp; Travels lists AC buses, non-AC buses and Tempo Travellers, and accepts enquiries about Urbania vehicles. Availability, layout and capacity should be confirmed for the requested date.</p>
                </section>

                <section aria-labelledby="guide-route-details">
                    <h2 id="guide-route-details">Share the route details before you set off</h2>
                    <p>Put the pickup point, first destination, planned stops and final drop-off in one clear itinerary. Let the group know where and when to assemble, and identify one person who can coordinate if traffic or a stop changes the timing.</p>
                    <p>When requesting transport, share your travel date, start time, route, passenger count and expected stops. Ask what the quoted fare covers, including any applicable distance, waiting, toll, parking or outstation charges. Do not rely on an unconfirmed online estimate.</p>
                </section>

                <section aria-labelledby="guide-flexible">
                    <h2 id="guide-flexible">Keep the day flexible and comfortable</h2>
                    <p>Traffic, weather, local events and destination access may affect how the day unfolds. Check current conditions and venue information close to departure, keep water and essentials available, and allow time for meals and rest. If the schedule is running late, decide together which stop matters most instead of rushing through all of them.</p>
                    <p>For longer or outstation journeys, confirm the driver’s reporting details, expected route, stops and return arrangement before travel. Clear expectations help the group and driver work from the same plan.</p>
                </section>

                <section aria-labelledby="guide-enquiry">
                    <h2 id="guide-enquiry">Request a vehicle for your Mumbai outing</h2>
                    <p>Make My Tours &amp; Travels serves enquiries for journeys in Mumbai, Thane and nearby areas. Tell the team where the group will start, where you plan to go and when you need to travel. They can confirm current vehicle availability and discuss the details of a trip-specific quote.</p>
                    <p>Explore <a href="/bus-hire/">bus hire</a> for group transport, compare <a href="/tempo-traveller-hire/">Tempo Traveller hire</a>, or ask directly about <a href="/urbania/">Urbania availability</a>. For other trip questions, see the <a href="/faqs/">frequently asked questions</a> or <a href="/contact/">contact the team</a>.</p>
                </section>
            </div>

            <aside class="article-page__sidebar" aria-label="Related travel information">
                <h2>Plan your group journey</h2>
                <p>Share your date, pickup point, destination and group size to ask about a suitable vehicle.</p>
                <x-button href="/#booking-form" variant="primary">Send a Trip Enquiry</x-button>
                <a class="text-link" href="/about/">About Make My Tours &amp; Travels</a>
            </aside>
        </div>
    </article>
@endsection
