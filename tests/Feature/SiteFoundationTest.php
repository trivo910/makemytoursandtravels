<?php

namespace Tests\Feature;

use Tests\TestCase;

class SiteFoundationTest extends TestCase
{
    public function test_home_uses_the_shared_layout_and_seo_metadata(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('<title>Bus Hire &amp; Tempo Traveller Rental in Mumbai | Make My Tours &amp; Travels</title>', false)
            ->assertSee('<link rel="canonical" href="https://makemytroursandtravels.com/">', false)
            ->assertSee('property="og:title" content="Bus Hire &amp; Tempo Traveller Rental in Mumbai"', false)
            ->assertSee('name="description"', false)
            ->assertSee('name="twitter:card" content="summary_large_image"', false)
            ->assertSee('name="twitter:title" content="Bus Hire &amp; Tempo Traveller Rental in Mumbai"', false)
            ->assertSee('images/mumbai-bus-travel-hero.jpg', false)
            ->assertSee('"@type":"Organization"', false)
            ->assertSee('aria-label="Main navigation"', false)
            ->assertSee('aria-controls="mobile-menu"', false)
            ->assertSee('aria-label="Mobile navigation"', false)
            ->assertSee('aria-controls="standards-submenu"', false)
            ->assertSee('aria-controls="mobile-standards-submenu"', false)
            ->assertSee('href="http://localhost/bus-hire/"', false)
            ->assertSee('href="http://localhost/urbania/"', false)
            ->assertSee('href="http://localhost/tempo-traveller-hire/"', false)
            ->assertSee('href="tel:+917718036300"', false)
            ->assertSee('>+91 77180 36300</strong>', false)
            ->assertSee(asset('images/make-my-tours-logo.png'), false)
            ->assertSee('id="main-content"', false);

        $this->assertFileExists(public_path('images/make-my-tours-logo.png'));
    }

    public function test_homepage_renders_all_sections_and_a_real_enquiry_form(): void
    {
        $response = $this->get('/');
        $html = $response->assertOk()->getContent();

        $this->assertSame(1, substr_count($html, '<h1'));
        $this->assertStringContainsString('id="booking-form"', $html);
        $this->assertStringContainsString('name="_token"', $html);
        $this->assertStringContainsString('name="name"', $html);
        $this->assertStringContainsString('name="phone"', $html);
        $this->assertStringContainsString('name="pickup_location"', $html);
        $this->assertStringContainsString('name="destination"', $html);
        $this->assertStringContainsString('name="travel_date"', $html);
        $this->assertStringContainsString('name="pickup_time"', $html);
        $this->assertStringContainsString('name="passenger_count"', $html);
        $this->assertStringContainsString('name="vehicle_type"', $html);
        $this->assertStringContainsString('method="POST"', $html);
        $this->assertStringContainsString('data-booking-form', $html);
        $this->assertStringContainsString('id="services"', $html);
        $this->assertStringContainsString('id="fleet"', $html);
        $this->assertStringContainsString('Our Bus Collection', $html);
        $this->assertStringContainsString('All Vehicle', $html);
        $this->assertStringContainsString('₹00', $html);
        $this->assertStringContainsString('50 Seat', $html);
        $this->assertStringContainsString('2 Driver Staff', $html);
        $this->assertStringContainsString('Fully Insured', $html);
        $this->assertStringContainsString('Book Now', $html);
        $this->assertStringContainsString('View Details', $html);
        $this->assertStringContainsString('Latest Articles &amp; Blog', $html);
        $this->assertStringContainsString('name="description"', $html);
        $this->assertStringNotContainsString('₹00/day', $html);
        $this->assertStringNotContainsString('href="#"', $html);
    }

    public function test_homepage_about_section_renders_the_wordpress_style_image_collage(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('<h2 id="about-title">Welcome to <span>Make My Tours &amp; Travels</span></h2>', $html);
        $this->assertStringContainsString('images/mumbai-tours-about-primary.png', $html);
        $this->assertStringContainsString('images/mumbai-tours-about-mobile.jpg', $html);
        $this->assertStringContainsString('Years Experience', $html);
        $this->assertStringContainsString('href="http://localhost/about/"', $html);
        $this->assertFileExists(public_path('images/mumbai-tours-about-primary.png'));
        $this->assertFileExists(public_path('images/mumbai-tours-about-mobile.jpg'));
    }

    public function test_homepage_why_choose_us_section_renders_the_wordpress_layout_and_metrics(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('images/make-my-why-choose-us.png', $html);
        $this->assertStringContainsString('alt="Family standing beside a Make My Tours &amp; Travels coach near the Gateway of India"', $html);
        $this->assertStringContainsString('Travel with Make My Tours &amp; Travels', $html);
        $this->assertStringContainsString('href="#booking-form">Book Your Tour', $html);
        $this->assertStringContainsString('<h2 id="trust-title">Make My Tours &amp; Travels – <span>Trusted</span> Since 2008</h2>', $html);
        $this->assertStringContainsString('comfortable journeys with well-maintained buses, experienced drivers, affordable fares, and carefully planned tours', $html);
        $this->assertSame(4, substr_count($html, 'class="stat-card"'));
        $this->assertStringContainsString('Years of Experience', $html);
        $this->assertStringContainsString('Happy Travelers', $html);
        $this->assertStringContainsString('Successful Tours', $html);
        $this->assertStringContainsString('Customer Satisfaction', $html);
        $this->assertFileExists(public_path('images/make-my-why-choose-us.png'));
    }

    public function test_homepage_journey_cta_uses_the_wordpress_background_and_phone_composition(): void
    {
        $html = $this->get('/')->assertOk()->getContent();
        $cta = substr($html, strpos($html, '<section class="journey-cta"'), strpos($html, '<section class="home-fleet') - strpos($html, '<section class="journey-cta"'));

        $this->assertStringContainsString('images/traveling-by-bus-interior.webp', $cta);
        $this->assertStringContainsString('images/book-your-mumbai-journey.jpg', $cta);
        $this->assertStringContainsString('alt="Mobile travel booking and Mumbai journey ticket screens"', $cta);
        $this->assertLessThan(strpos($cta, 'class="journey-cta__copy"'), strpos($cta, 'class="journey-cta__image"'));
        $this->assertStringContainsString('Book Your Journey Today', $cta);
        $this->assertStringContainsString('Travel Comfortably with Make My <span>Tours</span> &amp; Travels', $cta);
        $this->assertStringContainsString('family trip, corporate travel, airport transfer, or a sightseeing tour', $cta);
        $this->assertStringContainsString('href="tel:+917718036300"', $cta);
        $this->assertStringContainsString('Book Now', $cta);
        $this->assertFileExists(public_path('images/traveling-by-bus-interior.webp'));
        $this->assertFileExists(public_path('images/book-your-mumbai-journey.jpg'));
    }

    public function test_each_legacy_content_url_renders_unique_complete_seo_content(): void
    {
        $pages = [
            '/about/' => ['About Make My Tours & Travels | Mumbai Travel Since 2008', 'about/'],
            '/our-standards/' => ['Travel and Vehicle Standards | Make My Tours & Travels', 'our-standards/'],
            '/bus-hire/' => ['Bus Hire in Mumbai for Group Travel | Make My Tours & Travels', 'bus-hire/'],
            '/urbania/' => ['Force Urbania Rental Enquiries in Mumbai | Make My Tours & Travels', 'urbania/'],
            '/tempo-traveller-hire/' => ['Tempo Traveller Hire in Mumbai | Make My Tours & Travels', 'tempo-traveller-hire/'],
            '/faqs/' => ['Travel & Vehicle Hire FAQs | Make My Tours & Travels', 'faqs/'],
            '/contact/' => ['Contact Make My Tours & Travels | Mumbai', 'contact/'],
            '/hello-world/' => ['Planning a Mumbai Sightseeing Day Trip by Bus | Make My Tours & Travels', 'hello-world/'],
        ];

        $titles = [];
        $descriptions = [];

        foreach ($pages as $path => [$expectedTitle, $canonicalPath]) {
            $html = $this->get($path)->assertOk()
                ->assertSee('<link rel="canonical" href="https://makemytroursandtravels.com/' . $canonicalPath . '">', false)
                ->assertSee('property="og:title"', false)
                ->assertSee('name="twitter:title"', false)
                ->assertSee('application/ld+json', false)
                ->assertSee('aria-label="Breadcrumb"', false)
                ->getContent();

            $this->assertStringContainsString('<title>' . e($expectedTitle) . '</title>', $html, $path);
            $this->assertSame(1, preg_match_all('/<h1\b/i', $html), $path . ' has exactly one H1');
            $this->assertGreaterThan(0, preg_match_all('/<h2\b/i', $html), $path . ' has a section heading');
            $hasDescription = preg_match('/<meta name="description" content="([^"]+)"/', $html, $matches);
            $this->assertSame(1, $hasDescription, $path . ' has a description');
            $descriptions[] = $matches[1];
            $this->assertStringNotContainsString('<a href="#">', $html, $path . ' has no empty placeholder links');
            $titles[] = $expectedTitle;
        }

        $this->assertCount(count(array_unique($titles)), $titles, 'Every migrated page has a unique title.');
        $this->assertCount(count(array_unique($descriptions)), $descriptions, 'Every migrated page has a unique description.');
    }

    public function test_faq_and_legacy_blog_post_render_their_specific_content_and_schema(): void
    {
        $faqHtml = $this->get('/faqs/')->assertOk()
            ->assertSee('"@type":"FAQPage"', false)
            ->assertSee('What payment or cancellation terms apply?', false)
            ->getContent();

        $this->assertSame(7, substr_count($faqHtml, 'class="faq-item"'));

        $articleHtml = $this->get('/hello-world/')->assertOk()
            ->assertSee('"@type":"BlogPosting"', false)
            ->assertSee('Planning a Mumbai sightseeing day trip by bus', false)
            ->assertSee('Gateway of India', false)
            ->assertSee('Sassoon Dock', false)
            ->getContent();

        $this->assertStringNotContainsString('Hello world!', $articleHtml);
        $this->assertStringNotContainsString('Welcome to WordPress', $articleHtml);
    }

    public function test_unapproved_wordpress_archives_and_nonexistent_blog_index_are_not_recreated(): void
    {
        $this->get('/blog/')->assertNotFound();
        $this->get('/category/uncategorized/')->assertNotFound();
        $this->get('/author/makemytoursandtravels2080gmail-com/')->assertNotFound();
        $this->get('/not-a-real-page/')->assertNotFound();
    }

    public function test_seo_component_encodes_json_ld_safely(): void
    {
        $html = $this->blade(
            '<x-seo title="Schema test" :schema="$schema" />',
            ['schema' => [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => '</script><script>alert(1)</script>',
            ]]
        );

        $this->assertStringContainsString('type="application/ld+json"', $html);
        $this->assertStringContainsString('\\u003C\\/script\\u003E', $html);
        $this->assertStringNotContainsString('</script><script>alert(1)</script>', $html);
    }

    public function test_breadcrumb_component_marks_the_current_page(): void
    {
        $html = $this->blade(
            '<x-breadcrumbs :items="$items" />',
            ['items' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Bus Hire'],
            ]]
        );

        $this->assertStringContainsString('aria-label="Breadcrumb"', $html);
        $this->assertStringContainsString('aria-current="page"', $html);
        $this->assertStringContainsString('Bus Hire', $html);
    }

    public function test_reusable_card_components_render_their_content(): void
    {
        $html = $this->blade(<<<'BLADE'
            <x-card title="General card">General content</x-card>
            <x-service-card title="Bus hire" description="Group travel." href="/bus-hire/" />
            <x-fleet-card title="Coach" price="₹00" :specifications="['50 Seat', 'Fully Insured']" href="/bus-hire/" />
            <x-testimonial-card quote="A smooth trip." name="A traveler" />
            <x-article-card title="Travel guide" excerpt="A short guide." href="/hello-world/" />
            BLADE);

        $this->assertStringContainsString('General content', $html);
        $this->assertStringContainsString('Bus hire', $html);
        $this->assertStringContainsString('Group travel.', $html);
        $this->assertStringContainsString('₹00', $html);
        $this->assertStringContainsString('50 Seat', $html);
        $this->assertStringContainsString('A smooth trip.', $html);
        $this->assertStringContainsString('Travel guide', $html);
    }
}
