<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ContentPageController extends Controller
{
    private const PHONE = '+91 77180 36300';

    private const PHONE_LINK = 'tel:+917718036300';

    private const EMAIL = 'makemytoursplanner@gmail.com';

    public function show(string $pageKey): View
    {
        $pages = [
            'about' => [
                'title' => 'About Make My Tours & Travels | Mumbai Travel Since 2008',
                'description' => 'Meet Make My Tours & Travels, a Mumbai-based bus and traveller rental service supporting family, school, wedding, pilgrimage and group journeys since 2008.',
                'focusKeyword' => 'Make My Tours & Travels Mumbai',
                'heading' => 'Travel plans built around people and place',
                'eyebrow' => 'About Make My Tours & Travels',
                'lead' => 'Since 2008, Make My Tours & Travels has helped people plan group journeys from Mumbai. We arrange bus and traveller rental enquiries for city outings, events, sightseeing and outstation trips.',
                'image' => 'mumbai-tours-about-mobile.jpg',
                'imageAlt' => 'Passenger looking out across Mumbai from a tour bus',
                'imageWidth' => 1127,
                'imageHeight' => 1396,
                'sections' => [
                    [
                        'heading' => 'A Mumbai travel service with a local focus',
                        'paragraphs' => [
                            'Based in Mumbai, the business serves journeys in Mumbai, Thane and nearby areas. People enquire for family outings, corporate events, school trips, wedding functions, pilgrimages, sightseeing and outstation travel.',
                            'The right vehicle depends on the group and the journey. Make My Tours & Travels lists AC buses, non-AC buses and Tempo Travellers so customers can discuss an option that fits their trip.',
                        ],
                    ],
                    [
                        'heading' => 'Comfort and care on the road',
                        'paragraphs' => [
                            'The company describes its vehicles as clean and regularly maintained, with vehicles inspected before each trip. Passenger comfort and on-time service are stated priorities.',
                            'Experienced, courteous drivers familiar with local and outstation routes are part of the service described by the business. Ask the team about your specific route and travel date when requesting availability.',
                        ],
                    ],
                    [
                        'heading' => 'Start with the details of your trip',
                        'paragraphs' => [
                            'A useful enquiry includes your pickup point, destination, travel date, start time and approximate passenger count. The team can then discuss the vehicle options and trip arrangements relevant to your request.',
                            'For vehicle-specific information, read the bus hire, Tempo Traveller hire and Urbania pages. To ask a question directly, use the contact page.',
                        ],
                    ],
                ],
                'related' => [
                    ['title' => 'Bus Hire', 'description' => 'Compare group travel options and enquire about a bus for your journey.', 'href' => '/bus-hire/'],
                    ['title' => 'Tempo Traveller Hire', 'description' => 'Ask about a traveller for a family outing or smaller group trip.', 'href' => '/tempo-traveller-hire/'],
                ],
                'schemaType' => 'AboutPage',
            ],
            'our-standards' => [
                'title' => 'Travel and Vehicle Standards | Make My Tours & Travels',
                'description' => 'Learn about the cleanliness, vehicle maintenance, pre-trip inspections and courteous service priorities described by Make My Tours & Travels in Mumbai.',
                'focusKeyword' => 'bus travel standards Mumbai',
                'heading' => 'A considered approach to every journey',
                'eyebrow' => 'Our Standards',
                'lead' => 'Comfort, vehicle condition and reliable trip planning matter. Here is what Make My Tours & Travels publicly describes about its travel standards—and what to confirm for your own booking.',
                'image' => 'luxury-ac-coach.jpg',
                'imageAlt' => 'Passenger coach travelling on a road in Mumbai',
                'imageWidth' => 1525,
                'imageHeight' => 1031,
                'sections' => [
                    [
                        'heading' => 'Vehicle condition and cleanliness',
                        'paragraphs' => [
                            'The company describes its fleet as clean and regularly maintained, and says vehicles are inspected before every trip. Keeping the vehicle appropriate for the booked journey is part of making group travel more comfortable.',
                            'If your group has particular luggage, accessibility or seating needs, mention them before confirming so the available vehicle can be discussed for suitability.',
                        ],
                    ],
                    [
                        'heading' => 'Experienced, courteous drivers',
                        'paragraphs' => [
                            'Make My Tours & Travels describes its drivers as experienced, courteous and familiar with local and outstation routes. Share your pickup point, destination and any planned stops when requesting a trip.',
                            'Route conditions and traffic can change. Confirm the pickup arrangement and any timing expectations with the team for your travel date.',
                        ],
                    ],
                    [
                        'heading' => 'Clear trip details before you travel',
                        'paragraphs' => [
                            'Vehicle availability, configuration and fare depend on the specific request. Ask the team to confirm the vehicle type, pickup details, route, date, passenger count and quoted fare before making travel arrangements.',
                            'No third-party safety certification, fixed cancellation policy or guaranteed journey-time claim is published on this page. Contact the team for current booking terms and any details relevant to your trip.',
                        ],
                    ],
                ],
                'related' => [
                    ['title' => 'Bus Hire', 'description' => 'Explore bus options for group trips, events and sightseeing.', 'href' => '/bus-hire/'],
                    ['title' => 'Frequently Asked Questions', 'description' => 'Find answers about enquiries, availability and trip details.', 'href' => '/faqs/'],
                ],
                'schemaType' => 'WebPage',
            ],
            'bus-hire' => [
                'title' => 'Bus Hire in Mumbai for Group Travel | Make My Tours & Travels',
                'description' => 'Enquire about AC and non-AC bus hire in Mumbai for family outings, school trips, corporate events, weddings, pilgrimages and sightseeing.',
                'focusKeyword' => 'bus hire in Mumbai',
                'heading' => 'Bus hire for your next group journey',
                'eyebrow' => 'Bus Hire in Mumbai',
                'lead' => 'Planning transport for a group? Make My Tours & Travels offers enquiries for AC and non-AC buses for journeys in Mumbai, Thane and nearby areas.',
                'image' => 'luxury-ac-coach.jpg',
                'imageAlt' => 'Air-conditioned coach travelling through a city',
                'imageWidth' => 1525,
                'imageHeight' => 1031,
                'sections' => [
                    [
                        'heading' => 'Choose the bus type that suits your trip',
                        'paragraphs' => [
                            'The available fleet includes AC and non-AC buses. Comfort preferences, passenger count, luggage and route all help determine which option is suitable; confirm the available vehicle and configuration directly before booking.',
                            'The website does not publish verified seat counts or a current fare schedule. Request a trip-specific quote rather than relying on a generic per-day price.',
                        ],
                    ],
                    [
                        'heading' => 'Group journeys and occasions',
                        'paragraphs' => [
                            'Bus hire enquiries may suit family outings, school trips, corporate events, wedding functions, pilgrimages, sightseeing tours and outstation journeys. Share the purpose of travel so the team can understand your route and group requirements.',
                            'For trips outside Mumbai, confirm the route, included travel area, journey dates, stops and any additional charges with the team before agreeing to the booking.',
                        ],
                    ],
                    [
                        'heading' => 'Request availability and a quote',
                        'paragraphs' => [
                            'Tell us your pickup point, destination, date, preferred start time and approximate number of passengers. Also mention luggage, planned stops and whether you are considering an AC or non-AC bus.',
                            'Call +91 77180 36300 or use the trip enquiry form. You can also compare Tempo Traveller hire or ask about Urbania availability.',
                        ],
                    ],
                ],
                'related' => [
                    ['title' => 'Tempo Traveller Hire', 'description' => 'Explore a traveller option for family and smaller group trips.', 'href' => '/tempo-traveller-hire/'],
                    ['title' => 'Our Standards', 'description' => 'Read about vehicle condition and trip planning priorities.', 'href' => '/our-standards/'],
                ],
                'schemaType' => 'Service',
                'serviceName' => 'Bus hire in Mumbai',
            ],
            'urbania' => [
                'title' => 'Force Urbania Rental Enquiries in Mumbai | Make My Tours & Travels',
                'description' => 'Ask Make My Tours & Travels about Urbania availability for your Mumbai group journey, including current configuration, route and trip-specific fare.',
                'focusKeyword' => 'Urbania rental in Mumbai',
                'heading' => 'Ask us about an Urbania for your trip',
                'eyebrow' => 'Urbania Enquiries',
                'lead' => 'Looking for an Urbania for group travel? Share your date and journey details with Make My Tours & Travels to confirm current vehicle availability and configuration.',
                'sections' => [
                    [
                        'heading' => 'Confirm the vehicle for your travel date',
                        'paragraphs' => [
                            'Vehicle availability and configuration can vary. Before making plans, ask the team to confirm whether an Urbania is available for your date, the seating layout, passenger capacity, luggage suitability and any included amenities.',
                            'This page does not publish a fixed capacity, specification, price or guaranteed Urbania inventory. A trip-specific confirmation helps ensure the vehicle discussed matches your group’s needs.',
                        ],
                    ],
                    [
                        'heading' => 'Share your route and group requirements',
                        'paragraphs' => [
                            'Include your pickup area, destination, date, start time, passenger count and expected luggage. Mention planned stops and whether the trip is local or outstation so the team can respond to the actual journey.',
                            'Ask for the total fare and what it covers, including any applicable driver, distance, toll, parking or outstation charges, before confirming a booking.',
                        ],
                    ],
                    [
                        'heading' => 'Other vehicle options',
                        'paragraphs' => [
                            'If an Urbania does not fit your date or requirements, ask about the current Tempo Traveller options or AC and non-AC bus hire.',
                            'For availability, call +91 77180 36300 or send your trip details through the journey enquiry form.',
                        ],
                    ],
                ],
                'related' => [
                    ['title' => 'Tempo Traveller Hire', 'description' => 'Ask about a traveller configuration for your group and route.', 'href' => '/tempo-traveller-hire/'],
                    ['title' => 'Contact Us', 'description' => 'Speak to the team to confirm current Urbania availability.', 'href' => '/contact/'],
                ],
                'schemaType' => 'Service',
                'serviceName' => 'Urbania rental enquiries in Mumbai',
            ],
            'tempo-traveller-hire' => [
                'title' => 'Tempo Traveller Hire in Mumbai | Make My Tours & Travels',
                'description' => 'Enquire about Tempo Traveller hire in Mumbai for family outings, sightseeing, events and outstation group trips. Confirm capacity and fare for your date.',
                'focusKeyword' => 'Tempo Traveller hire in Mumbai',
                'heading' => 'Tempo Traveller hire for group trips',
                'eyebrow' => 'Tempo Traveller Hire',
                'lead' => 'For family outings and smaller group journeys, ask Make My Tours & Travels about a Tempo Traveller for your route, date and passenger requirements.',
                'image' => 'tempo-traveller.jpg',
                'imageAlt' => 'Passenger traveller vehicle for a Mumbai group journey',
                'imageWidth' => 1525,
                'imageHeight' => 1031,
                'sections' => [
                    [
                        'heading' => 'A practical option for families and groups',
                        'paragraphs' => [
                            'A Tempo Traveller may suit family outings, sightseeing, wedding functions, pilgrimages and outstation trips where your group would like to travel together. Confirm the available layout and vehicle configuration for your date.',
                            'Passenger capacity, luggage space, amenities and price are not fixed on this page. Tell the team how many people are travelling and ask them to confirm that the proposed vehicle is suitable.',
                        ],
                    ],
                    [
                        'heading' => 'Plan the pickup, destination and stops',
                        'paragraphs' => [
                            'When requesting a quote, provide your pickup point, destination, travel date, start time, approximate passenger count and any planned stops. Mention luggage or other requirements that may affect vehicle choice.',
                            'For outstation journeys, check which route and trip costs are included in the quote. Confirm the booking terms directly with the team before travel.',
                        ],
                    ],
                    [
                        'heading' => 'Ask about availability',
                        'paragraphs' => [
                            'Availability depends on your travel date. Call +91 77180 36300 or use the trip enquiry form to discuss your request.',
                            'You may also want to compare bus hire for a larger group or enquire about an Urbania if a specific vehicle type is important to you.',
                        ],
                    ],
                ],
                'related' => [
                    ['title' => 'Bus Hire', 'description' => 'Compare AC and non-AC bus enquiries for group journeys.', 'href' => '/bus-hire/'],
                    ['title' => 'Frequently Asked Questions', 'description' => 'See what to confirm before requesting a group vehicle.', 'href' => '/faqs/'],
                ],
                'schemaType' => 'Service',
                'serviceName' => 'Tempo Traveller hire in Mumbai',
            ],
        ];

        abort_unless(isset($pages[$pageKey]), 404);

        $page = $pages[$pageKey];
        $siteUrl = config('site.canonical_url');
        $page['canonical'] = $siteUrl . '/' . $pageKey . '/';
        $page['ogTitle'] = $page['heading'] . ' | Make My Tours & Travels';
        $page['ogImage'] = $siteUrl . '/images/' . ($page['image'] ?? 'mumbai-bus-travel-hero.jpg');
        $page['breadcrumbs'] = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => $page['heading']],
        ];
        $page['schema'] = $this->pageSchema($page);

        return view('pages.content', ['page' => $page]);
    }

    public function faqs(): View
    {
        $faqs = [
            [
                'question' => 'What details should I share when requesting a vehicle?',
                'answer' => 'Provide your pickup point, destination, travel date, preferred start time and approximate passenger count. Mention luggage, planned stops and whether you are considering a bus, Tempo Traveller or Urbania.',
            ],
            [
                'question' => 'Which vehicle types can I ask about?',
                'answer' => 'The website lists AC buses, non-AC buses, Tempo Travellers and Urbania enquiries. Availability and configurations can vary, so confirm the current vehicle for your date.',
            ],
            [
                'question' => 'Where does Make My Tours & Travels operate?',
                'answer' => 'The business is based in Mumbai and describes service across Mumbai, Thane and nearby areas. Ask the team to confirm coverage for your pickup and destination.',
            ],
            [
                'question' => 'Can I request a vehicle for an event or group outing?',
                'answer' => 'The published travel uses include family outings, corporate events, school trips, wedding functions, pilgrimages, sightseeing and outstation journeys. Share your trip requirements to discuss a suitable option.',
            ],
            [
                'question' => 'How much does bus or traveller hire cost?',
                'answer' => 'A fare depends on the vehicle, route, date and trip requirements. No verified fare table is published here. Request a written trip-specific quote and confirm what it includes before booking.',
            ],
            [
                'question' => 'How do I check availability or confirm passenger capacity?',
                'answer' => 'Call +91 77180 36300 or send your trip details using the journey enquiry form. Ask the team to confirm availability, vehicle configuration, passenger and luggage suitability, fare and booking terms for your date.',
            ],
            [
                'question' => 'What payment or cancellation terms apply?',
                'answer' => 'Payment, advance and cancellation terms are not published on this site. Confirm the current terms directly with the team before you make a payment or finalize your plans.',
            ],
        ];

        $title = "Travel & Vehicle Hire FAQs | Make My Tours & Travels";
        $description = 'Answers to common questions about bus hire, Tempo Travellers, Urbania enquiries, service areas, trip details, fares and booking terms.';
        $siteUrl = config('site.canonical_url');
        $canonical = $siteUrl . '/faqs/';
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            '@id' => $canonical . '#faq',
            'url' => $canonical,
            'name' => "Travel and vehicle hire FAQs",
            'mainEntity' => array_map(fn (array $faq) => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ], $faqs),
        ];

        return view('pages.faqs', [
            'title' => $title,
            'description' => $description,
            'focusKeyword' => 'bus and traveller hire FAQs Mumbai',
            'canonical' => $canonical,
            'ogTitle' => $title,
            'ogImage' => $siteUrl . '/images/mumbai-bus-travel-hero.jpg',
            'schema' => $schema,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => "FAQs"],
            ],
            'faqs' => $faqs,
        ]);
    }

    public function contact(): View
    {
        $siteUrl = config('site.canonical_url');
        $canonical = $siteUrl . '/contact/';
        $title = 'Contact Make My Tours & Travels | Mumbai';
        $description = 'Contact Make My Tours & Travels in Andheri West, Mumbai to ask about buses, Tempo Travellers, Urbania, routes and trip availability.';

        return view('pages.contact', [
            'title' => $title,
            'description' => $description,
            'focusKeyword' => 'contact bus hire Mumbai',
            'canonical' => $canonical,
            'ogTitle' => $title,
            'ogImage' => $siteUrl . '/images/mumbai-bus-travel-hero.jpg',
            'schema' => [
                '@context' => 'https://schema.org',
                '@type' => 'ContactPage',
                '@id' => $canonical . '#contact',
                'url' => $canonical,
                'name' => $title,
                'mainEntity' => [
                    '@type' => 'Organization',
                    '@id' => $siteUrl . '/#organization',
                    'name' => 'Make My Tours & Travels',
                    'url' => $siteUrl . '/',
                    'telephone' => self::PHONE,
                    'email' => self::EMAIL,
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'E-120, Puspanjali Bldg, Seven Bunglow',
                        'addressLocality' => 'Andheri West, Mumbai',
                        'addressCountry' => 'IN',
                    ],
                ],
            ],
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Contact'],
            ],
            'phone' => self::PHONE,
            'phoneLink' => self::PHONE_LINK,
            'email' => self::EMAIL,
            'address' => 'E-120, Puspanjali Bldg, Seven Bunglow, Andheri West, Mumbai',
            'mapUrl' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode('E-120, Puspanjali Bldg, Seven Bunglow, Andheri West, Mumbai'),
        ]);
    }

    public function article(): View
    {
        $siteUrl = config('site.canonical_url');
        $canonical = $siteUrl . '/hello-world/';
        $title = 'Planning a Mumbai Sightseeing Day Trip by Bus | Make My Tours & Travels';
        $description = 'Plan a smoother Mumbai sightseeing day by grouping key landmarks, allowing for city traffic and choosing group transport that suits your itinerary.';

        return view('pages.article', [
            'title' => $title,
            'description' => $description,
            'focusKeyword' => 'Mumbai sightseeing by bus',
            'canonical' => $canonical,
            'ogTitle' => $title,
            'ogImage' => $siteUrl . '/images/mumbai-bus-travel-hero.jpg',
            'schema' => [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                '@id' => $canonical . '#article',
                'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $canonical],
                'headline' => $title,
                'description' => $description,
                'image' => $siteUrl . '/images/mumbai-bus-travel-hero.jpg',
                'datePublished' => '2026-10-02',
                'dateModified' => '2026-10-02',
                'inLanguage' => 'en-IN',
                'author' => [
                    '@type' => 'Organization',
                    '@id' => $siteUrl . '/#organization',
                    'name' => 'Make My Tours & Travels',
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    '@id' => $siteUrl . '/#organization',
                    'name' => 'Make My Tours & Travels',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => $siteUrl . '/images/make-my-tours-logo.png',
                    ],
                ],
            ],
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Mumbai Sightseeing Day Trip'],
            ],
        ]);
    }

    private function pageSchema(array $page): array
    {
        $siteUrl = config('site.canonical_url');
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => $page['schemaType'],
            '@id' => $page['canonical'] . '#page',
            'url' => $page['canonical'],
            'name' => $page['heading'],
            'description' => $page['description'],
            'inLanguage' => 'en-IN',
            'publisher' => [
                '@type' => 'Organization',
                '@id' => $siteUrl . '/#organization',
                'name' => 'Make My Tours & Travels',
            ],
        ];

        if (isset($page['serviceName'])) {
            $schema['mainEntity'] = [
                '@type' => 'Service',
                'name' => $page['serviceName'],
                'description' => $page['description'],
                'provider' => [
                    '@type' => 'Organization',
                    '@id' => $siteUrl . '/#organization',
                    'name' => 'Make My Tours & Travels',
                ],
                'areaServed' => ['Mumbai', 'Thane'],
            ];
        }

        if (isset($page['image'])) {
            $schema['image'] = config('site.canonical_url') . '/images/' . $page['image'];
        }

        return $schema;
    }
}
