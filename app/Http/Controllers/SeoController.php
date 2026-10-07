<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $paths = [
            '/',
            '/about/',
            '/our-standards/',
            '/bus-hire/',
            '/urbania/',
            '/tempo-traveller-hire/',
            '/faqs/',
            '/contact/',
            '/hello-world/',
        ];

        return response()
            ->view('seo.sitemap', [
                'urls' => array_map(
                    fn (string $path): string => config('site.canonical_url') . $path,
                    $paths,
                ),
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(): Response
    {
        $body = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Disallow: /booking-enquiries/',
            'Disallow: /up',
            'Sitemap: ' . config('site.canonical_url') . '/sitemap.xml',
            '',
        ]);

        return response($body, 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
