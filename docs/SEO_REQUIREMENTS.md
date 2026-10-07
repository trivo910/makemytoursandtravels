# SEO Requirements for Laravel Migration

Audit date: 2026-10-02

## Audit baseline and risks

- Live WordPress provides a sitemap index and page/post/category/author sitemap files. `robots.txt` disallows `/wp-admin/` and references the sitemap. The sitemap listed eight pages, one post, one category archive, and one author archive.
- Sampled URLs had self-referencing canonical links and `max-image-preview:large`; sampled page heads had no `meta name="description"`. The homepage title was “Buses, Tempo Traveller on Rent Mumbai – Make My Tours & Travels”; page titles were generally page-specific. Recheck all metadata directly at migration time.
- The public homepage displays `₹00/day` fleet pricing, and the blog contains `Hello world!`; both are conspicuous content-quality risks.
- WordPress inner-page rendering sampled for Bus Hire, Tempo Traveller Hire, Urbania, Our Standards, FAQ's, and Contact was largely a heading plus generic repeated copy/footer. Thin or duplicative content risks poor relevance and indexing quality.
- Generic `Projects`, `Pricing`, and `Services` footer labels do not all match sitemap-confirmed pages. The homepage prototype has numerous `#` links and fake/demo contact details.
- The local Laravel app currently has no per-page SEO metadata, canonical strategy, sitemap implementation, redirects, or business-page routes. `public/robots.txt` is permissive (`Disallow:` is empty); this is not a substitute for a correct production crawler policy.
- The public pages expose phone/address/email and an author URL containing an email-derived identifier; validate data consistency and minimize personal/account information.

## Laravel homepage implementation

- The homepage has a unique title and description, self-referencing canonical, unique Open Graph title, Open Graph description/image/URL, Twitter large-image card, and `index, follow` robots directives.
- Its server-rendered markup contains one visible H1, section H2s/card H3s, descriptive alt text for informative images (empty alt is reserved for decorative imagery), stable local filenames, internal links, Organization/WebSite JSON-LD, and responsive image dimensions.
- The booking form persists a validated trip enquiry with CSRF/rate-limit/honeypot protections and sends an email notification; a delivery failure is surfaced without discarding the stored enquiry.
- The homepage links to the implemented content URLs. The preserved `/hello-world/` starter-post URL now contains an original guide; the original WordPress starter text is not present. Archive handling remains deferred as documented below.
- The live fleet's `₹00/day` values remain excluded. Unsupported homepage counts and unverified testimonial quotations have been removed. Customer names/portraits visible on the live site remain; confirm permission before publication. Car rental remains in the service list because the live homepage lists it; confirm it is still offered.

## Per-indexable-page requirements

- Unique, concise, human-written `<title>` aligned with that URL's primary user intent and location where useful; do not mechanically duplicate keyword strings.
- Unique `meta description` that accurately summarizes the page and offers a clear reason to visit; treat it as a search snippet, not a ranking guarantee.
- Exactly one clear, visible page-level H1, followed by a logical heading hierarchy. Ensure headings are not hidden text or decorative section labels alone.
- Self-referencing canonical URL on the preferred HTTPS host, consistent trailing-slash policy, and no canonical to unrelated pages.
- Indexable pages should return 200, render substantive unique HTML content without requiring client-side interaction, and link to relevant sibling/service/contact pages.
- Use descriptive, stable internal links and breadcrumbs where useful. Replace empty `#` links and dead CTAs with actual destinations or remove them.
- Do not publish placeholder copy, unsupported fleet price/capacity, fabricated testimonials, or unverified travel claims. Use reviewed copy and appropriate business contact/service facts.

## Structured data and local business information

- Review the production HTML and Search Console before selecting schema types; the audit did not establish a valid existing JSON-LD implementation.
- If accurate and eligible, add validated `TravelAgency` or an appropriate `LocalBusiness` subtype schema using consistent public business name, address, phone, URL, and opening hours. Do not invent ratings, prices, services, or social profiles.
- Add service/vehicle offer structured data only for real, current offerings and pricing. Mark up reviews only when genuine, attributable, visible, and policy-compliant; do not self-serve star ratings.
- Keep name/address/phone/email consistent between website, map/business listings, contact page, and structured data. The live site contact details observed in this audit are documented in `WEBSITE_STRUCTURE.md`; reconfirm with the business before reuse.
- FAQ structured data should reflect visible, real FAQ answers and current search-engine eligibility; visible FAQs are useful even if enhanced SERP display is unavailable.

## Final Laravel indexable-page audit

Audit date: 2026-10-02. Automated audit tests rendered every URL below and checked successful responses, exactly one title and description, unique title/description/OG title/OG description, canonical/OG URL equality, canonical-host share images, robots directives, one H1, heading-level sequence, expected valid JSON-LD types, breadcrumbs where appropriate, local internal link responses, and image assets/alt attributes. Focus keywords below are editorial targets, not emitted `meta keywords` (which is obsolete and intentionally omitted).

| Indexable URL | Focus keyword | Unique title/description | H1 and content | JSON-LD / breadcrumbs | Status |
|---|---|---|---|---|---|
| `/` | bus hire and tempo traveller rental Mumbai | Yes | One H1: “Buses & Tempo Travellers on Rent in Mumbai”; ordered sections; local informative-image alt text and service/article links | `Organization`, `WebSite`; no breadcrumb expected for homepage | Pass; homepage refinement reviewed 2026-10-02 |
| `/about/` | Make My Tours & Travels Mumbai | Yes | One H1; company, local service and trip-planning sections | `AboutPage`, `BreadcrumbList` | Pass |
| `/our-standards/` | bus travel standards Mumbai | Yes | One H1; maintenance, driver and trip detail sections | `WebPage`, `BreadcrumbList` | Pass |
| `/bus-hire/` | bus hire in Mumbai | Yes | One H1; AC/non-AC group bus guidance | `Service`, `BreadcrumbList` | Pass |
| `/urbania/` | Urbania rental in Mumbai | Yes | One H1; date-specific configuration/availability guidance; no unsupported specs | `Service`, `BreadcrumbList` | Pass |
| `/tempo-traveller-hire/` | Tempo Traveller hire in Mumbai | Yes | One H1; group-use and quote-planning sections | `Service`, `BreadcrumbList` | Pass |
| `/faqs/` | bus and traveller hire FAQs Mumbai | Yes | One H1; seven visible answers | `FAQPage`, `BreadcrumbList` | Pass |
| `/contact/` | contact bus hire Mumbai | Yes | One H1; public phone/email/address and working enquiry link | `ContactPage`, `BreadcrumbList` | Pass; reconfirm business NAP |
| `/hello-world/` | Mumbai sightseeing by bus | Yes | One H1; original guide with contextual links and image alt | `BlogPosting`, `BreadcrumbList` | Pass; legacy slug retained by approval |

All nine pages are self-canonical on `https://makemytroursandtravels.com/`, have page-appropriate social metadata and emit explicit `index, follow` for robots/googlebot. The shared component defaults canonical generation to `SEO_CANONICAL_URL` plus the request path, never the incoming Host header; explicit page canonicals use that same configured origin. Set `SEO_CANONICAL_URL` to the production origin and `APP_URL` to the same canonical origin in the production environment. Do not put credentials in either variable.

`/sitemap.xml` is valid XML and contains exactly the nine canonical 200 pages above. It omits POST/utility routes, `/up`, 404s, and deferred WordPress archives. `/robots.txt` allows public pages, excludes only the POST endpoint and health endpoint, and identifies the sitemap. Both endpoints are generated from `SEO_CANONICAL_URL` by Laravel so staging can use its own origin. No static `public/robots.txt` shadows the environment-aware route.

Automated link/image audit passed: internal anchor targets return successful responses; local image files exist and all rendered image elements define `alt` (empty alt is retained only on decorative hero/testimonial imagery). JSON-LD parses as JSON and contains no local `localhost` or `127.0.0.1` origin. The crawler metadata contains no accidental `noindex`. The public asset URLs use Laravel's `APP_URL`; ensure this is also set to the production HTTPS canonical origin at deploy time.

## Homepage refinement SEO recheck

- Updated the homepage meta description to describe bus and Tempo Traveller hire from Mumbai without unverifiable performance claims. The existing title, canonical, Open Graph/Twitter metadata and Organization/WebSite JSON-LD remain unchanged.
- The revised page has one H1, “Buses & Tempo Travellers on Rent in Mumbai,” followed by the existing ordered section headings. Informative local images retain alt attributes and stable filenames.
- Removed unsupported traveller/tour/satisfaction counts and review quotations. No Review/AggregateRating schema is emitted. Vehicle pricing remains omitted.
- Laravel feature tests and Vite production build passed after the content/CSS refinement. Local browser review found no horizontal overflow or broken images at 320, 375, 390, 414, 768, 1024, 1280 and 1440 CSS-pixel viewport widths; mobile menu open and Escape-close behavior passed.
- Manual review remains required for supplied screenshot comparison, customer portrait/review permissions, current car-rental availability, and production NAP confirmation.

Generated `/category/uncategorized/` and `/author/makemytoursandtravels2080gmail-com/` archives remain excluded from the sitemap and return 404 pending Search Console/backlink/owner disposition. No `/blog/` index exists in the audited sitemap. Do not add these thin/duplicate URLs as indexable pages without an approved content/redirect decision.

Page imagery uses descriptive local filenames and contextual ALT text when informative; the article/article-card imagery is local and relevant to the described journey. All public metadata uses `https://makemytroursandtravels.com/` as the canonical origin observed during the audit.

The WordPress sitemap also listed `/category/uncategorized/` and `/author/makemytoursandtravels2080gmail-com/`. These are generated archives, not curated content pages; rendering either as a duplicate single-article archive would produce thin/duplicated content and expose an email-derived author slug. They have not been recreated or redirected without Search Console, backlink and owner approval. The audit found no `/blog/` index and no separate vehicle detail URLs beyond `/bus-hire/`, `/urbania/` and `/tempo-traveller-hire/`; no replacement URLs have been invented. The legacy archive and nonexistent `/blog/` paths return 404 pending an approved disposition.

## Technical SEO and performance

- Use one canonical hostname over HTTPS; redirect alternate scheme/host variants directly to it.
- Generate and maintain a sitemap containing only canonical, indexable 200 URLs. Submit it at cutover; remove stale WordPress-only URLs only after approved migration/redirect handling.
- Configure production `robots.txt` to allow intended public pages and disallow only genuinely private/utility routes. Never rely on robots blocking to remove indexed sensitive URLs.
- Return meaningful 404 responses for unknown paths. Implement the approved 301 map and avoid redirect chains, loops, soft-404s, and unrelated redirects.
- Add Open Graph/social metadata and appropriate share image for important pages; verify previews.
- Optimize local responsive images (format, dimensions, compression, `srcset`/`sizes`, lazy loading below fold), reserve image layout space, and provide contextual alt text. Decorative imagery should have empty alt or be CSS backgrounds; avoid blank alt on informative fleet/service photos.
- Keep essential content and links crawlable in server-rendered HTML. Use semantic landmarks, mobile-friendly viewport/layout, keyboard operability, and readable contrast.
- Measure Core Web Vitals/performance on real production pages, address render-blocking CSS/JS and third-party dependency risks, and avoid external stock-photo/font dependencies unless licensed, stable, and performant.
- Add analytics/Search Console verification and conversion events without leaking personal form data. Ensure cookie/privacy requirements are reviewed for the target jurisdiction and analytics stack.

## Forms and SEO-sensitive conversion behavior

- Booking/contact forms need clear labels, meaningful field names, correct input types, server-side validation, accessible errors, spam controls, privacy/consent text where required, and an explicit success/failure state.
- Define a safe post-submit URL/status and avoid indexing query-string variations, form result pages, or duplicate parameter URLs.
- Verify phone/email links, booking CTAs, newsletter actions, and confirmation messages. No success path should be implied unless submission reaches the responsible service.

## Validation gates before launch

- Crawl all inventory URLs from `SEO_URL_MAP.md`; assert status, title, description, canonical, robots directive, H1, internal links, image status/alt, and redirect destination.
- Validate sitemap XML, `robots.txt`, structured data, social preview, HTTPS/host redirects, and custom 404.
- Compare the final URL/indexability set against approved legacy sitemap and redirect decisions.
- Use Search Console/index coverage, analytics landing pages, and backlink/traffic evidence to decide archive/starter-post disposition.
