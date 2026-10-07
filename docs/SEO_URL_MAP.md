# SEO URL Inventory and Migration Map

Audit date: 2026-10-02

## Current production URLs

The WordPress sitemap index is published at `https://makemytroursandtravels.com/wp-sitemap.xml`. Its child sitemaps contain these URLs:

| Current URL | Sitemap source / observed page | Suggested Laravel destination | Migration note |
|---|---|---|---|
| `/` | Page sitemap; homepage | `/` | Preserve. Rebuild as the canonical homepage; maintain one canonical origin/protocol. |
| `/about/` | Page sitemap; About | `/about/` | Preserve exact path and trailing-slash policy. |
| `/tempo-traveller-hire/` | Page sitemap; Tempo Traveller Hire | `/tempo-traveller-hire/` | Preserve; make content genuinely vehicle/service-specific. |
| `/bus-hire/` | Page sitemap; Bus Hire | `/bus-hire/` | Preserve; retain all useful bus-hire content and search intent. |
| `/urbania/` | Page sitemap; Urbania | `/urbania/` | Preserve; confirm exact Urbania offering and current vehicle/fleet facts. |
| `/our-standards/` | Page sitemap; Our Standards | `/our-standards/` | Preserve if this page remains useful; author substantive standards/safety information. |
| `/faqs/` | Page sitemap; FAQ's | `/faqs/` | Preserve; migrate and validate real questions/answers. |
| `/contact/` | Page sitemap; Contact | `/contact/` | Preserve; implement working contact channels/form and accurate business NAP. |
| `/hello-world/` | Post sitemap; WordPress starter post | `/hello-world/` | Preserved by owner direction and replaced with an original substantive Mumbai sightseeing group-travel guide. The URL slug remains weak; consider a descriptive slug only after indexing/backlink review and approval. |
| `/category/uncategorized/` | Category sitemap archive | No assumed replacement | Empty/low-value archive candidate for consolidation or `noindex`; check indexed status, inbound links, and post membership first. |
| `/author/makemytroursandtravels2080gmail-com/` | Author sitemap archive | No assumed replacement | Candidate to suppress/consolidate only after checking indexed status and links; remove exposed account/email-derived slug if a replacement author archive is not required. |

The sitemap page entries reported last modified dates between 2026-07-09 and 2026-07-11; the starter post was last modified 2026-06-29. These are the sitemap timestamps observed on audit date, not freshness guarantees.

The sitemap support URLs observed were `/wp-sitemap.xml`, `/wp-sitemap-posts-page-1.xml`, `/wp-sitemap-posts-post-1.xml`, `/wp-sitemap-taxonomies-category-1.xml`, `/wp-sitemap-users-1.xml`, and `/robots.txt`. These are discovery/technical endpoints, not content landing pages to recreate as Laravel pages.

## App URL inventory (current Laravel)

| Method | Laravel URL | Current result |
|---|---|---|
| GET/HEAD | `/` | Homepage with hero, enquiry, about, trust, services, fleet, testimonials, article teaser and contact footer. |
| GET/HEAD | `/about/` | Company and Mumbai group-travel information. |
| GET/HEAD | `/our-standards/` | Vehicle-condition and trip-planning information. |
| GET/HEAD | `/bus-hire/` | AC and non-AC group bus hire information. |
| GET/HEAD | `/urbania/` | Urbania availability/configuration enquiry information. |
| GET/HEAD | `/tempo-traveller-hire/` | Tempo Traveller hire information. |
| GET/HEAD | `/faqs/` | Seven visible vehicle/trip FAQs. |
| GET/HEAD | `/contact/` | Public contact details and trip enquiry links. |
| GET/HEAD | `/hello-world/` | Substantive Mumbai sightseeing guide at the preserved WordPress post URL. |
| GET/HEAD | `/up` | Laravel framework health endpoint configured in `bootstrap/app.php`; not a public content URL. |

`php artisan route:list --except-vendor` verifies the eight preserved content/article URLs plus the homepage. The audited generated category and email-derived author archive URLs remain unimplemented and return 404 pending an approved SEO disposition. No `/blog/` index or additional unlisted fleet URLs were discovered or created. Laravel also registers its framework `/up` health endpoint and storage routes.

## URL and cutover requirements

1. Confirm canonical host (`https` and preferred `www`/non-`www` form), trailing slash convention, and ensure every equivalent host/path variant redirects consistently.
2. Keep the existing content-page slugs unchanged unless evidence supports a change. If a path must change, create a one-hop permanent redirect to its closest relevant replacement.
3. Do not replace the sitemap set with only the Laravel root route. Add sitemap entries only for indexable, canonical, successful content URLs; omit admin, utility, duplicate, and intentionally noindexed pages.
4. Record old URL, new URL, status, canonical, and owner approval in a redirect/cutover matrix. Avoid redirect chains, loops, irrelevant homepage redirects, and redirecting a retired URL to a page with different intent.
5. Inspect Search Console, analytics, backlinks, server logs, and current index status before retiring the starter post, category archive, or author archive.
6. Verify each preserved URL returns the intended 200 page (or intentional 301), has one canonical, and works with/without trailing slash according to policy.
7. After launch, submit the new sitemap, monitor 404s/redirects/indexing and conversion tracking, and retain the redirect map for at least the site's agreed migration period.
