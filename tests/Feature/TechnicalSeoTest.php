<?php

namespace Tests\Feature;

use DOMDocument;
use DOMXPath;
use Tests\TestCase;

class TechnicalSeoTest extends TestCase
{
    private const INDEXABLE_PAGES = [
        '/' => 'bus hire and tempo traveller rental Mumbai',
        '/about/' => 'Make My Tours & Travels Mumbai',
        '/our-standards/' => 'bus travel standards Mumbai',
        '/bus-hire/' => 'bus hire in Mumbai',
        '/urbania/' => 'Urbania rental in Mumbai',
        '/tempo-traveller-hire/' => 'Tempo Traveller hire in Mumbai',
        '/faqs/' => 'bus and traveller hire FAQs Mumbai',
        '/contact/' => 'contact bus hire Mumbai',
        '/hello-world/' => 'Mumbai sightseeing by bus',
    ];

    private const PAGE_SCHEMA_TYPES = [
        '/' => 'Organization',
        '/about/' => 'AboutPage',
        '/our-standards/' => 'WebPage',
        '/bus-hire/' => 'Service',
        '/urbania/' => 'Service',
        '/tempo-traveller-hire/' => 'Service',
        '/faqs/' => 'FAQPage',
        '/contact/' => 'ContactPage',
        '/hello-world/' => 'BlogPosting',
    ];

    public function test_every_indexable_page_has_complete_unique_metadata_and_canonical_schema(): void
    {
        $titles = [];
        $descriptions = [];
        $ogTitles = [];
        $ogDescriptions = [];
        $origin = config('site.canonical_url');

        foreach (self::INDEXABLE_PAGES as $path => $focusKeyword) {
            $html = $this->get($path)->assertOk()->getContent();
            $xpath = $this->xpath($html);
            $canonical = $origin . ($path === '/' ? '/' : $path);
            $title = $this->meta($xpath, '//title');
            $description = $this->meta($xpath, '//meta[@name="description"]/@content');

            $this->assertSame(1, $xpath->query('//title')->length, "$path has exactly one title element");
            $this->assertSame(1, $xpath->query('//meta[@name="description"]')->length, "$path has exactly one meta description");
            $this->assertNotSame('', $title, "$path has a title");
            $this->assertNotSame('', $description, "$path has a description");
            $this->assertSame(1, $xpath->query('//link[@rel="canonical"]')->length, "$path has one canonical");
            $this->assertSame($canonical, $xpath->evaluate('string(//link[@rel="canonical"]/@href)'), "$path canonical is self-referencing");
            $this->assertSame('index, follow', $this->meta($xpath, '//meta[@name="robots"]/@content'), "$path is indexable");
            $this->assertSame('index, follow', $this->meta($xpath, '//meta[@name="googlebot"]/@content'), "$path has a crawl directive");
            $ogTitle = $this->meta($xpath, '//meta[@property="og:title"]/@content');
            $this->assertNotSame('', $ogTitle, "$path has an OG title");
            $ogDescription = $this->meta($xpath, '//meta[@property="og:description"]/@content');
            $this->assertNotSame('', $ogDescription, "$path has an OG description");
            $this->assertSame($canonical, $this->meta($xpath, '//meta[@property="og:url"]/@content'), "$path OG URL matches canonical");
            $this->assertNotSame('', $this->meta($xpath, '//meta[@property="og:image"]/@content'), "$path has an OG image");
            $ogImageUrl = $this->meta($xpath, '//meta[@property="og:image"]/@content');
            $this->assertSame(parse_url($origin, PHP_URL_HOST), parse_url($ogImageUrl, PHP_URL_HOST), "$path OG image uses the canonical host");
            $ogImagePath = parse_url($ogImageUrl, PHP_URL_PATH);
            $this->assertFileExists(public_path(ltrim($ogImagePath, '/')), "$path OG image exists");
            $this->assertSame('summary_large_image', $this->meta($xpath, '//meta[@name="twitter:card"]/@content'), "$path has a Twitter card");
            $this->assertSame($ogTitle, $this->meta($xpath, '//meta[@name="twitter:title"]/@content'), "$path Twitter title matches OG");
            $this->assertSame($description, $this->meta($xpath, '//meta[@name="twitter:description"]/@content'), "$path Twitter description matches");
            $this->assertSame(1, $xpath->query('//h1')->length, "$path has one H1");
            $this->assertGreaterThan(0, $xpath->query('//h2')->length, "$path has H2 content");
            $expectedSchemaCount = $path === '/' ? 1 : 2;
            $expectedBreadcrumbCount = $path === '/' ? 0 : 1;
            $this->assertGreaterThanOrEqual($expectedSchemaCount, $xpath->query('//script[@type="application/ld+json"]')->length, "$path has appropriate structured data");
            $this->assertSame($expectedBreadcrumbCount, $xpath->query('//nav[@aria-label="Breadcrumb"]')->length, "$path has appropriate breadcrumbs");
            $this->assertStringNotContainsString('localhost', $canonical);
            $this->assertStringNotContainsString('127.0.0.1', $canonical);
            $this->assertNotSame('', $focusKeyword);

            foreach ($xpath->query('//script[@type="application/ld+json"]') as $script) {
                $this->assertIsArray(json_decode($script->textContent, true, flags: JSON_THROW_ON_ERROR), "$path JSON-LD is valid JSON");
                $this->assertStringNotContainsString('localhost', $script->textContent);
                $this->assertStringNotContainsString('127.0.0.1', $script->textContent);
            }
            $schemaText = implode('', array_map(
                fn ($script): string => $script->textContent,
                iterator_to_array($xpath->query('//script[@type="application/ld+json"]')),
            ));
            $this->assertStringContainsString('"@type":"' . self::PAGE_SCHEMA_TYPES[$path] . '"', $schemaText, "$path uses an appropriate schema type");

            $titles[] = $title;
            $descriptions[] = $description;
            $ogTitles[] = $ogTitle;
            $ogDescriptions[] = $ogDescription;

            $this->assertHeadingHierarchy($xpath, $path);
            $this->assertLocalLinksResolve($xpath, $path);
            $this->assertLocalImagesExistAndHaveAlt($xpath, $path);
        }

        $this->assertCount(count(array_unique($titles)), $titles, 'Page titles are unique.');
        $this->assertCount(count(array_unique($descriptions)), $descriptions, 'Meta descriptions are unique.');
        $this->assertCount(count(array_unique($ogTitles)), $ogTitles, 'Open Graph titles are unique.');
        $this->assertCount(count(array_unique($ogDescriptions)), $ogDescriptions, 'Open Graph descriptions are unique.');
    }

    public function test_sitemap_lists_only_the_indexable_canonical_pages_as_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        $xml = new DOMDocument;
        $this->assertTrue($xml->loadXML($response->getContent()));

        $xpath = new DOMXPath($xml);
        $xpath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $locations = [];

        foreach ($xpath->query('//sm:url/sm:loc') as $location) {
            $locations[] = $location->textContent;
        }

        $expected = array_map(
            fn (string $path): string => config('site.canonical_url') . ($path === '/' ? '/' : $path),
            array_keys(self::INDEXABLE_PAGES),
        );
        $this->assertSame($expected, $locations);
    }

    public function test_robots_txt_allows_public_content_and_names_the_canonical_sitemap(): void
    {
        $body = $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->getContent();

        $this->assertStringContainsString("User-agent: *\nAllow: /", $body);
        $this->assertStringContainsString('Disallow: /booking-enquiries/', $body);
        $this->assertStringContainsString('Sitemap: ' . config('site.canonical_url') . '/sitemap.xml', $body);
    }

    private function xpath(string $html): DOMXPath
    {
        $document = new DOMDocument;
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML($html);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        return new DOMXPath($document);
    }

    private function meta(DOMXPath $xpath, string $query): string
    {
        return trim($xpath->evaluate("string($query)"));
    }

    private function assertHeadingHierarchy(DOMXPath $xpath, string $path): void
    {
        $headings = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');
        $lastLevel = 0;

        foreach ($headings as $heading) {
            $level = (int) substr(strtolower($heading->nodeName), 1);
            $this->assertLessThanOrEqual(1, $level - $lastLevel, "$path heading hierarchy does not skip levels");
            $lastLevel = $level;
        }
    }

    private function assertLocalLinksResolve(DOMXPath $xpath, string $sourcePath): void
    {
        foreach ($xpath->query('//a[@href]') as $anchor) {
            $href = trim($anchor->getAttribute('href'));
            if ($href === '' || str_starts_with($href, '#') || str_starts_with($href, 'mailto:') || str_starts_with($href, 'tel:')) {
                continue;
            }

            $url = parse_url($href);
            if (isset($url['host']) && ! in_array($url['host'], ['localhost', '127.0.0.1', parse_url(config('site.canonical_url'), PHP_URL_HOST)], true)) {
                continue;
            }

            $target = $url['path'] ?? '/';
            if (isset($url['host']) && $target === '') {
                $target = '/';
            }
            if (isset($url['host']) && isset($url['query'])) {
                continue;
            }

            $this->get($target)->assertSuccessful("Broken internal link from $sourcePath to $href");
        }
    }

    private function assertLocalImagesExistAndHaveAlt(DOMXPath $xpath, string $path): void
    {
        foreach ($xpath->query('//img') as $image) {
            $source = parse_url($image->getAttribute('src'), PHP_URL_PATH);
            $this->assertTrue($image->hasAttribute('alt'), "$path image has an alt attribute (empty is allowed for decorative images)");

            if ($source !== null && str_starts_with($source, '/images/')) {
                $this->assertFileExists(public_path(ltrim($source, '/')), "$path image file exists");
                $this->assertMatchesRegularExpression(
                    '/^[a-z0-9]+(?:-[a-z0-9]+)*\.(?:jpg|jpeg|png|webp|svg)$/',
                    basename($source),
                    "$path image has a stable SEO-friendly filename",
                );
            }
        }
    }
}
