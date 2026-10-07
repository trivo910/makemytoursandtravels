<?php

namespace Tests\Feature;

use App\Models\Redirect as LegacyRedirect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LegacyRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_approved_changed_url_redirects_permanently_directly_to_a_live_page(): void
    {
        LegacyRedirect::query()->create([
            'source_path' => '/old-about/',
            'destination_url' => '/about/',
            'status_code' => 301,
            'is_active' => true,
        ]);

        $this->get('/old-about/')
            ->assertStatus(301)
            ->assertHeader('Location', config('site.canonical_url') . '/about/');

        $this->get('/about/')->assertOk();
    }

    public function test_legacy_chains_are_collapsed_to_a_single_permanent_redirect(): void
    {
        LegacyRedirect::query()->create([
            'source_path' => '/old-company/',
            'destination_url' => '/about-alias/',
            'status_code' => 301,
            'is_active' => true,
        ]);
        LegacyRedirect::query()->create([
            'source_path' => '/about-alias/',
            'destination_url' => '/about/',
            'status_code' => 301,
            'is_active' => true,
        ]);

        $this->get('/old-company/')
            ->assertStatus(301)
            ->assertHeader('Location', config('site.canonical_url') . '/about/');

        $this->get('/about/')->assertOk();
    }

    public function test_redirect_loops_and_unsafe_or_dead_destinations_return_404(): void
    {
        LegacyRedirect::query()->create([
            'source_path' => '/loop-a/',
            'destination_url' => '/loop-b/',
            'status_code' => 301,
            'is_active' => true,
        ]);
        LegacyRedirect::query()->create([
            'source_path' => '/loop-b/',
            'destination_url' => '/loop-a/',
            'status_code' => 301,
            'is_active' => true,
        ]);
        LegacyRedirect::query()->create([
            'source_path' => '/external/',
            'destination_url' => '//example.com/',
            'status_code' => 301,
            'is_active' => true,
        ]);
        LegacyRedirect::query()->create([
            'source_path' => '/dead-target/',
            'destination_url' => '/unresolved-destination/',
            'status_code' => 301,
            'is_active' => true,
        ]);

        $this->get('/loop-a/')->assertNotFound();
        $this->get('/external/')->assertNotFound();
        $this->get('/dead-target/')->assertNotFound();
        $this->get('/not-mapped/')->assertNotFound();
    }

    public function test_current_legacy_urls_remain_direct_pages_without_redirects(): void
    {
        foreach (['/', '/about/', '/our-standards/', '/bus-hire/', '/urbania/', '/tempo-traveller-hire/', '/faqs/', '/contact/', '/hello-world/'] as $path) {
            $this->get($path)->assertOk();
        }

        $this->assertDatabaseCount('redirects', 0);
    }

    public function test_unapproved_wordpress_archives_remain_404_without_invented_redirects(): void
    {
        $this->get('/category/uncategorized/')->assertNotFound();
        $this->get('/author/makemytoursandtravels2080gmail-com/')->assertNotFound();

        $this->assertDatabaseCount('redirects', 0);
    }
}
