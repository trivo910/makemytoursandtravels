# Development Log

## Phase 2: Laravel architecture foundation

Date: 2026-10-02

### Implemented

- Added a shared Blade application layout with skip link, semantic header/main/footer landmarks, Vite assets, page content section, and extensible head/script stacks.
- Replaced the prior all-in-one homepage concept with a minimal foundation placeholder; no complete homepage or inner-page content was built.
- Added reusable header and footer components. Navigation uses the audited page paths, preserves trailing slashes for the planned content URLs, identifies the current page, and provides a contact CTA without inventing business contact data.
- Added responsive desktop navigation and an accessible mobile menu with expanded state, Escape close/focus return, link-close behavior, and breakpoint-change reset.
- Added reusable button, breadcrumb, general card, service card, fleet card, testimonial card, and article card components.
- Added reusable title/description/robots, canonical, Open Graph, Twitter card, and JSON-LD metadata support. JSON-LD serialization uses Laravel's `Js::encode` to safely encode markup-sensitive values.
- Replaced the minimal stylesheet with global design tokens and styles aligned to the documented cream/charcoal/orange concept, shared controls/cards/footer, visible focus, reduced-motion support, and responsive breakpoints at 70rem, 48rem, and 32.5rem.
- Kept the existing Vite entry structure (`resources/css/app.css` and `resources/js/app.js`) and implemented the mobile menu in the existing JavaScript entry.
- Added feature tests for shared-layout output, SEO/canonical metadata, safely encoded JSON-LD, breadcrumbs, and reusable card rendering.

The CSS uses the documented Poppins-first font stack with system fallbacks, but does not fetch a third-party font: confirm font licensing/hosting before adding a font asset or remote font request.

### Files created

- `resources/views/layouts/app.blade.php`
- `resources/views/components/seo.blade.php`
- `resources/views/components/site-header.blade.php`
- `resources/views/components/site-footer.blade.php`
- `resources/views/components/button.blade.php`
- `resources/views/components/breadcrumbs.blade.php`
- `resources/views/components/card.blade.php`
- `resources/views/components/service-card.blade.php`
- `resources/views/components/fleet-card.blade.php`
- `resources/views/components/testimonial-card.blade.php`
- `resources/views/components/article-card.blade.php`
- `tests/Feature/SiteFoundationTest.php`
- `docs/DEVELOPMENT_LOG.md`

### Files modified

- `resources/views/welcome.blade.php` — now extends the shared layout and contains only a temporary foundation message.
- `resources/css/app.css` — replaced starter Tailwind-only styling with the global design system.
- `resources/js/app.js` — added responsive mobile navigation behavior.
- `routes/web.php` — named the existing root route `home`.

`vite.config.js`, `package.json`, and Composer manifests were not modified. Vite's existing CSS/JavaScript entrypoints remain in use.

### Validation

- `npm run build` — passed with Vite 7.3.6.
- `php artisan test --compact` — passed: 6 tests, 24 assertions.
- `php artisan view:cache` — passed.
- `php artisan route:list --except-vendor` — passed; the root content route remains the only app-authored route.
- Browser check at 320px, 390px, 768px, 1024px, and 1440px — no horizontal overflow; desktop navigation and mobile toggle switch at the responsive breakpoint.
- Mobile menu open, Escape close, hidden-state update, and focus return — verified.
- Workspace diagnostics for changed Blade, CSS, JavaScript, route, and feature-test files — no errors reported.

Vite was initially unavailable because npm dependencies were not installed. Dependencies were restored with `npm install --no-package-lock`; no root npm lockfile or package-manifest change was created. Production build output is generated under the ignored `public/build/` directory.

### Scope not implemented

Business pages, homepage sections, verified contact details, booking/contact submission, data models, admin/authentication, final logo/media, production sitemap/redirects, and approved production typography remain future work.

## Phase 3: Live-site header and navigation

Date: 2026-10-02

### Implemented

- Reworked the shared header to follow the live site: floating white rounded navigation bar, locally served bus wordmark, dark desktop links, orange active state, and orange click-to-call contact CTA.
- Matched the production menu hierarchy: Home, About, Our Standards (Bus Hire and Urbania dropdown), Tempo Traveller Hire, FAQ's, and Contact. Links retain the legacy trailing-slash paths from `SEO_URL_MAP.md`.
- Added a desktop dropdown that works with hover, keyboard focus, and an explicit accessible toggle.
- Replaced the former inline mobile links with a responsive right-side navigation drawer. It includes a backdrop, close button, nested collapsible Our Standards menu, telephone CTA, body scroll lock, Escape/backdrop/link closing, keyboard focus trap, and focus return.
- The desktop links and telephone CTA are replaced by the hamburger/drawer below 76rem; header layout remains within the requested 320–1440px widths.
- Downloaded the visible live brand image from the site's public media URL to `public/images/make-my-tours-logo.png` so the header does not depend on a runtime third-party image request.
- Preserved the existing footer wordmark styling after replacing the shared header brand mark with the real logo image.
- Extended foundation feature tests to cover the logo, live navigation hierarchy, phone CTA, and mobile/dropdown landmarks.

The live page was inspected in the shared browser. No separate desktop/mobile screenshot files were attached in this turn; the live page's displayed desktop header and responsive mobile navigation were used as reference.

### Files created

- `public/images/make-my-tours-logo.png` — production site's transparent 1600×406 logo image.

### Files modified

- `resources/views/components/site-header.blade.php` — logo, navigation hierarchy/dropdown, contact CTA, and mobile drawer markup.
- `resources/css/app.css` — floating header, logo, desktop dropdown, contact CTA, mobile drawer, and responsive header breakpoints.
- `resources/js/app.js` — dropdown interaction and accessible mobile drawer behavior.
- `tests/Feature/SiteFoundationTest.php` — header rendering and required navigation/content assertions.
- `docs/DEVELOPMENT_LOG.md` — this Phase 3 record.

### Validation

- `npm run build` — passed with Vite 7.3.6 after header implementation.
- `php artisan test --compact` — passed: 6 tests, 32 assertions.
- View diagnostics reported no errors in the changed header, CSS, JavaScript, and feature test.
- Browser viewport audit at 320px, 375px, 390px, 414px, 768px, 1024px, 1280px, and 1440px — no horizontal document overflow. Mobile navigation is used through 1216px; full desktop navigation and contact CTA appear at 1280px and 1440px.
- Interaction checks passed for the mobile drawer open/close controls, backdrop, Escape, telephone CTA, nested Bus Hire/Urbania submenu, body scroll lock, and forward/reverse keyboard focus trapping with focus return.
- Desktop dropdown checks passed for pointer entry/exit, explicit toggle, Escape, and synchronized expanded/display state.
- Live asset check confirmed the downloaded logo loads in the local page. Header and drawer widths fit at the narrowest 320px viewport.

### Scope not implemented

No homepage sections, inner-page content, booking form, new URL routes, or additional business data were added. The next phase should confirm whether the live phone contact detail remains current before production launch.

## Phase 4: Homepage

Date: 2026-10-02

### Implemented

- Replaced the foundation placeholder with the homepage's live section order: hero and CTAs, booking enquiry form, company introduction, trust/statistics, six travel services, journey CTA banner, three vehicle cards, four customer testimonials, an honest empty blog state, and the shared contact footer.
- Reused Blade components for section headings, statistics, service cards, fleet cards, testimonials, buttons, and the enquiry form. Homepage content sets are data-driven rather than repeated card markup.
- Recreated the full-width, dark-overlay bus hero and floating shared header, with responsive hero copy and an overlapping booking panel. Added responsive section/card layouts and a narrow-screen one-column enquiry form.
- Added a labelled trip form with required pickup, destination, date, time, and passenger fields. On valid submit it opens a prefilled WhatsApp enquiry to the number observed on the live site. This is a direct handoff only; no Laravel storage, email, CRM, booking confirmation, or server-side submission has been added. A phone-call fallback is present for no-JavaScript use.
- Replaced the generic footer with the public site's logo, navigation, observed public contact details, and trip-planning CTA. No nonfunctional newsletter form was added.
- Added a homepage-specific SEO title and description, the production canonical, Open Graph and Twitter/X metadata, and `Organization`/`WebSite` JSON-LD. Business address, opening hours, offers, and review/rating schema were deliberately excluded pending verification.
- Kept one visible H1 and added semantic section H2s/card H3s, useful alternative text, image dimensions, a high-priority hero image, and lazy-loaded below-fold photos.
- Downloaded the production homepage's existing vehicle/travel imagery and testimonial portraits into descriptive local assets, then compressed the large photographs to JPEG. The combined photographic assets are substantially smaller than their multi-megabyte PNG sources.
- Removed the live page's invalid `₹00/day` placeholder fares and replaced the sole WordPress `Hello world!` blog teaser with a no-articles-yet message; no fake article or destination URL is presented.
- Fixed the global 320px minimum body width after responsive checks found a 15px horizontal overflow at the narrowest viewport.

### Files created

- `resources/views/components/home-section-heading.blade.php`
- `resources/views/components/stat-card.blade.php`
- `resources/views/components/booking-form.blade.php`
- `public/images/mumbai-bus-travel-hero.jpg`
- `public/images/mumbai-tours-about-mobile.jpg`
- `public/images/book-your-mumbai-journey.jpg`
- `public/images/luxury-ac-coach.jpg`
- `public/images/non-ac-bus.jpg`
- `public/images/tempo-traveller.jpg`
- `public/images/testimonial-dhanesh-panchal.jpg`
- `public/images/testimonial-priya-mehta.jpg`
- `public/images/testimonial-rahul-sharma.jpg`
- `public/images/testimonial-purnima-thakur.jpg`

### Files modified

- `resources/views/welcome.blade.php` — complete server-rendered homepage content and page SEO data.
- `resources/views/layouts/app.blade.php` — optional body class used to overlay the shared header on the homepage hero.
- `resources/views/components/service-card.blade.php` — optional numbered service-card marker.
- `resources/views/components/fleet-card.blade.php` — descriptive image dimensions and contextual detail-link labels.
- `resources/views/components/testimonial-card.blade.php` — optional customer portraits and accessible customer identity layout.
- `resources/views/components/site-footer.blade.php` — live-site-style branding, contact details, links, and trip CTA.
- `resources/css/app.css` — responsive homepage sections, form, cards, banner, footer, and narrow-screen overflow fix.
- `resources/js/app.js` — valid trip enquiry handoff to WhatsApp.
- `tests/Feature/SiteFoundationTest.php` — homepage SEO, section, single-H1, and enquiry form assertions.
- `docs/SEO_REQUIREMENTS.md` — homepage metadata/schema/form requirements and unresolved content validation notes.
- `docs/DEVELOPMENT_LOG.md` — Phase 4 implementation, changed-file list, scope notes, and validation.

### Validation

- `npm run build` — passed with Vite 7.3.6.
- `php artisan test --compact` — passed: 7 tests, 51 assertions.
- Browser-tested at 320, 375, 390, 414, 768, 1024, 1280, and 1440px. Document width did not exceed the viewport after fixing the 320px minimum-width overflow; the mobile/desktop header breakpoint switches as expected.
- Inspected the mobile hero and 1440px desktop hero, about section, testimonial cards, journey banner, and fleet cards in the browser.
- Submitted a populated enquiry form in the browser and verified it opens a `wa.me` URL for `+91 77180 36300` containing the pickup, destination, date, time, and passenger details.
- Checked loaded hero/about/logo assets and current HTML for one H1, canonical/social metadata, and valid internal fragment links.
- Workspace diagnostics reported no errors in the changed Blade, CSS, JavaScript, and feature-test files.

### Follow-up before launch

- Confirm public phone/email/address, testimonial permissions, 15+ years and other trust figures, fleet descriptions, and legacy business copy with the owner.
- Reconfirm production canonical host and ensure the hero/social image paths exist on the production deployment.
- Implement or approve destinations/redirects for legacy inner-page links before they are exposed to production visitors.
- Review the authored Mumbai sightseeing guide and decide whether to retain the legacy `/hello-world/` slug or plan a later redirect using search/index/backlink evidence.
- Confirm whether enquiries should remain WhatsApp-only or should be persisted/routed through an approved booking or CRM backend, including privacy and consent wording.

No inner page, new route, or full blog page was added in this phase.

## Phase 5: Core content pages and legacy travel article

Date: 2026-10-02

### Implemented

- Added server-rendered pages at the audited WordPress paths: `/about/`, `/our-standards/`, `/bus-hire/`, `/urbania/`, `/tempo-traveller-hire/`, `/faqs/`, and `/contact/`.
- Preserved `/hello-world/` per owner direction and replaced the starter text with an original, substantive group sightseeing guide about planning a Mumbai day trip. The homepage's existing blog teaser now links to this article; no new `/blog/` URL was created.
- Verified the current live About content and confirmed the other sampled standards/service/FAQ/contact pages still have only heading shells and generic footer copy. Authored distinct, page-specific copy without inventing vehicle capacities, prices, specifications, booking terms, certification or guarantees.
- Added a shared content-page template with the current site header/footer, breadcrumbs, unique H1, semantic H2 sections, local descriptive images where appropriate, calls to action and reusable related-service cards.
- Added substantive, visible FAQ answers; current public contact details with phone/email/map links; and per-page structured data that matches visible page intent/content.
- Added unique title/description/canonical/Open Graph/Twitter metadata for each page. JSON-LD types include `AboutPage`, `WebPage`, `Service`, `FAQPage`, `ContactPage` and `BlogPosting`. Did not add ratings/review markup or assert unverified commercial facts.
- Recorded each page's focus-keyword target and exact legacy URL in `SEO_REQUIREMENTS.md`; no deprecated meta-keywords field is emitted.
- Left generated WordPress category and email-derived author archives unimplemented pending search-index/backlink review and approved redirect/noindex handling. The sitemap contained no blog index or additional fleet-detail URLs, so neither `/blog/` nor other unlisted pages were invented.

### Files created

- `app/Http/Controllers/ContentPageController.php`
- `resources/views/pages/content.blade.php`
- `resources/views/pages/faqs.blade.php`
- `resources/views/pages/contact.blade.php`
- `resources/views/pages/article.blade.php`

### Files modified

- `routes/web.php` — eight preserved content/article URLs and named routes.
- `resources/views/welcome.blade.php` — internal link to the preserved article.
- `resources/views/pages/article.blade.php` — visible publisher byline and article date.
- `resources/css/app.css` — responsive inner-page, FAQ, contact and article designs.
- `tests/Feature/SiteFoundationTest.php` — route/SEO/schema/heading/content and deferred URL assertions.
- `docs/SEO_REQUIREMENTS.md` — page-by-page focus keyword, schema and archive handling map.
- `docs/SEO_URL_MAP.md` — current Laravel route inventory and approved `/hello-world/` handling.
- `docs/DEVELOPMENT_LOG.md` — this phase record and validation notes.

### Validation

- `php artisan test --compact` — passed: 10 tests, 156 assertions, including unique-title/description checks and 404 assertions for deferred archive and unlisted URL handling.
- `npm run build` — passed with Vite 7.3.6 after adding the inner-page styles.
- `php artisan route:list --except-vendor` — verified all eight preserved content routes plus the homepage.
- Browser requests confirmed each content route returns 200 with a unique title, description, matching trailing-slash canonical, OG/Twitter metadata, JSON-LD, one H1 and section headings.
- Internal links on the content pages resolve to implemented routes. The category/author archive URLs, unlisted `/blog/` path and a nonexistent path return 404 rather than duplicate archive content.
- Browser-tested all eight pages at 320px, 390px, 768px and 1440px (32 route/viewport checks): no horizontal overflow, missing H1, or broken rendered page image.
- Inspected the desktop About and FAQ pages, mobile Contact and legacy-URL article layouts: breadcrumbs, active navigation, loaded images and responsive content layouts render correctly.

## Phase 6: Database-driven architecture

Date: 2026-10-02

### Implemented

- Added additive migrations for editable pages, services, fleet vehicles, service/vehicle assignments, testimonials, FAQs, blog categories/posts, polymorphic SEO metadata, contact enquiries, booking enquiries, redirects, and extensible user roles.
- Added Eloquent models with typed relationships, casts, publication/active scopes, foreign-key deletion behavior, unique slugs, and a one-to-one SEO metadata relation.
- Added validated contact and booking Form Requests. Booking validation checks that a selected fleet vehicle exists and is active; both enquiry requests require at least one valid contact method.
- Added a role catalogue seeder and `User::roles()` / `User::hasRole()` support without altering the existing user migration or assigning elevated access to any account.
- Removed the pre-existing predictable test-user creation from `DatabaseSeeder`; it now only seeds the role catalogue, preventing routine database seeding from introducing a default login.
- Documented the schema, relationships, privacy and content-sanitization considerations, migration inventory, and current integration boundaries in `docs/DATABASE_STRUCTURE.md`.
- Did not add submission routes, persistence controllers, admin pages, or alter the current WhatsApp enquiry handoff.

The configured local SQLite database was inspected read-only and contains two existing session rows. No migration or seeder was run against that persistent database. Validation is performed using the test suite's in-memory SQLite database.

### Files created

- `database/migrations/2026_10_02_000001_create_content_tables.php`
- `database/migrations/2026_10_02_000002_create_blog_tables.php`
- `database/migrations/2026_10_02_000003_create_seo_enquiry_and_redirect_tables.php`
- `database/migrations/2026_10_02_000004_create_role_tables.php`
- `app/Models/Page.php`
- `app/Models/Service.php`
- `app/Models/Vehicle.php`
- `app/Models/Testimonial.php`
- `app/Models/Faq.php`
- `app/Models/BlogCategory.php`
- `app/Models/BlogPost.php`
- `app/Models/SeoMetadata.php`
- `app/Models/ContactEnquiry.php`
- `app/Models/BookingEnquiry.php`
- `app/Models/Redirect.php`
- `app/Models/Role.php`
- `app/Http/Requests/StoreContactEnquiryRequest.php`
- `app/Http/Requests/StoreBookingEnquiryRequest.php`
- `database/seeders/RoleSeeder.php`
- `tests/Feature/DatabaseArchitectureTest.php`
- `docs/DATABASE_STRUCTURE.md`

### Files modified

- `app/Models/User.php` — many-to-many roles, role-check helper and authored-post relation.
- `database/seeders/DatabaseSeeder.php` — seeds roles without creating a default test login.
- `docs/DEVELOPMENT_LOG.md` — this phase record.

### Validation

- `php artisan test --compact` — passed: 15 tests, 196 assertions, including schema creation, relationships, publication scopes, role assignment, enquiry validation and safe seeding.
- `vendor\bin\pint --test` on all changed PHP files — passed.
- Editor diagnostics for the changed PHP model, request, migration, seeder and test files — no errors reported.
- Database and relationship tests use `RefreshDatabase` against `:memory:` SQLite; the persistent local SQLite database remains unchanged.
- Rechecked the persistent SQLite database read-only: its three original migrations remain applied and its two session rows remain present.

### Scope not implemented

No admin authentication/CMS, authorization policies, public form endpoints, enquiry processing/notifications, content migration/seeding, or production database migration was implemented. Add explicit route authorization and public-form spam/retention protections before enabling those workflows.

### Follow-up before launch

- Reconfirm public contact details/NAP, the current availability and specifications for bus/Urbania/Tempo Traveller, fares, and the exact terms the business wants customers to rely on.
- Review and approve public claims and the new authored travel guide. The Urbania and Tempo Traveller pages intentionally direct customers to confirm date-specific availability, capacity and features.
- Make an analytics/Search Console-informed decision for the legacy article slug, category archive and email-derived author archive before production cutover. The existing archive paths currently return 404.
- Verify the production host/canonical origin, public image deployment and social previews before launch.

No advanced booking, payment, authentication, admin, persistent enquiry, mail delivery, or new unlisted content URL was implemented.

## Phase 7: Booking and trip enquiries

Date: 2026-10-02

### Implemented

- Replaced the homepage's WhatsApp-only trip form with a responsive POST form preserving pickup, destination, date, time, and passenger fields, and adding name, phone, optional email, vehicle preference, and optional trip notes.
- Added native browser validation, visible field errors, retained safe old input, accessible success/error summaries, a CSRF token, and an unobtrusive honeypot.
- Connected the form to a named, throttled web route and existing `StoreBookingEnquiryRequest`; validated fields are persisted as a new booking enquiry. Vehicle type options are allow-listed and optional related vehicle IDs must reference an active vehicle.
- Added an HTML email notification to the environment-configured booking recipient. Delivery failures are logged without enquiry body or transport details and shown as a clear “saved but notification failed” message so customers can call.
- Added a locally configurable booking recipient (`MAIL_BOOKING_TO`) without exposing SMTP credentials. The sample environment retains Laravel's log mailer; production must configure a real mail transport and protected credentials.
- Applied the four pending additive schema migrations to the configured local SQLite development database only after verifying their status; the prior migration batches and session data were preserved.
- No payment/booking confirmation, availability hold, or contact-page persistence was implied by the enquiry workflow.

### Files created

- `app/Http/Controllers/BookingEnquiryController.php`
- `app/Mail/BookingEnquiryReceived.php`
- `resources/views/emails/booking-enquiry.blade.php`
- `tests/Feature/BookingEnquiryTest.php`

### Files modified

- `routes/web.php` — named POST route with rate limiting.
- `app/Http/Requests/StoreBookingEnquiryRequest.php` — form field allow-list, input validation and honeypot.
- `app/Models/BookingEnquiry.php` — persisted vehicle preference.
- `database/migrations/2026_10_02_000003_create_seo_enquiry_and_redirect_tables.php` — optional vehicle preference column.
- `resources/views/components/booking-form.blade.php` — CSRF-protected, accessible form with mobile fields and status feedback.
- `resources/css/app.css` — responsive input/select/textarea, validation and status styles.
- `resources/js/app.js` — preserve native POST validation and focus server errors.
- `config/mail.php` and `.env.example` — recipient configuration only; no credentials added.
- `tests/Feature/SiteFoundationTest.php` — updated homepage booking form assertions.
- `docs/DATABASE_STRUCTURE.md` — booking form persistence, recipient configuration and privacy notes.
- `docs/DEVELOPMENT_LOG.md` — this phase record.

### Validation

- `php artisan test --compact --filter=BookingEnquiryTest` — passed: 6 tests covering valid, invalid, empty, honeypot, rate-limited, stored, email-notified, and delivery-failure submissions, plus CSRF/web middleware.
- `npm run build` — passed with Vite 7.3.6.
- `vendor\bin\pint --test` — passed for changed PHP files.
- `php artisan test --compact` — passed: 21 tests, 257 assertions.
- Mail-fake tests confirmed the notification recipient and enquiry content; a separate transport-failure test confirmed the saved request is retained and a clear error is surfaced. Live SMTP delivery still requires deployment credentials.
- Browser-tested native empty-form blocking followed by a valid submission at a 375px CSS viewport: success feedback rendered and document width stayed 375px with no horizontal overflow. Removed the two synthetic browser-test records afterward; the persistent booking enquiry table is empty.
- The earlier mobile browser pass exposed an invalid modern HTML telephone `pattern`; removed the fragile client pattern and rely on native required validation plus the server-side telephone rule.
- Applied pending migrations using `php artisan migrate --force` only after `php artisan migrate:status` showed the expected four new additive migrations. Persistent local enquiry table started empty; existing session rows were retained.

### Follow-up before production

- Configure a real outbound mail transport via protected deployment environment values and perform a delivery verification without exposing credentials.
- Confirm the correct operational recipient, consent/privacy notice, retention/deletion policy, secure access for enquiry records, and spam controls such as bot challenge if abuse warrants it.

## Phase 8: Technical SEO implementation and crawl audit

Date: 2026-10-02

### Implemented

- Centralized the canonical origin in `config/site.php` via `SEO_CANONICAL_URL`; all page canonicals, home JSON-LD, share images, sitemap and robots sitemap reference this configured origin rather than the request Host header.
- Completed shared Open Graph and Twitter/X metadata for every indexable page, including page-specific title/description, canonical OG URL, valid local share image, image alt, and large-image card declarations.
- Added explicit `index, follow` robots/googlebot directives and safely encoded `BreadcrumbList` JSON-LD to pages with visible breadcrumbs. The homepage appropriately has no breadcrumb.
- Implemented `/sitemap.xml` with only the nine canonical, indexable 200 content pages and `/robots.txt` with environment-aware sitemap origin, public crawling allowed, and only the enquiry POST/health utility paths excluded. Removed the static robots file to prevent it shadowing environment-aware output.
- Audited all nine indexable pages for unique title, description, OG title/description, one H1, ordered heading levels, canonical/OG URL self-reference, robots directives, JSON-LD validity/type, visible breadcrumbs where applicable, internal link responses, and existing descriptive local image filenames/alt attributes.
- Updated `docs/SEO_REQUIREMENTS.md` with final per-page focus keyword/schema/status and the completed crawl/metadata checks.

### Files created

- `config/site.php`
- `app/Http/Controllers/SeoController.php`
- `resources/views/seo/sitemap.blade.php`
- `tests/Feature/TechnicalSeoTest.php`

### Files modified

- `.env.example` — documented non-secret `SEO_CANONICAL_URL`.
- `app/Http/Controllers/ContentPageController.php` — schema/image URLs use the configured canonical origin.
- `resources/views/welcome.blade.php` — homepage canonical and Organization/WebSite schema use configured origin.
- `resources/views/components/seo.blade.php` — configured-origin canonical fallback, OG/Twitter fields, default robots directives, breadcrumb JSON-LD.
- `resources/views/layouts/app.blade.php` — forwards robots and breadcrumb metadata.
- `resources/views/pages/content.blade.php`, `resources/views/pages/faqs.blade.php`, `resources/views/pages/contact.blade.php`, and `resources/views/pages/article.blade.php` — pass breadcrumb data to shared metadata component.
- `routes/web.php` — sitemap and robots endpoints.
- `public/robots.txt` — removed so it cannot shadow environment-aware Laravel output.
- `tests/Feature/TechnicalSeoTest.php` — full page, schema, link, asset, sitemap and robots audit.
- `docs/SEO_REQUIREMENTS.md` — final audit status for every indexable page.
- `docs/DEVELOPMENT_LOG.md` — this phase record.

### Validation

- `php artisan test --compact --filter=TechnicalSeoTest` — passed: 3 tests, 919 assertions covering nine pages, unique metadata, canonical/OG URLs, robots indexability, heading order, JSON-LD, internal links, image files/alt, sitemap XML, and robots output.
- `php artisan test --compact` — passed: 24 tests, 1,176 assertions.
- `npm run build` — passed with Vite 7.3.6.
- `vendor\bin\pint --test` — passed for changed PHP files.
- Editor diagnostics for changed SEO controllers, config, Blade views and tests — no errors reported.
- `php artisan route:list` — confirmed `/sitemap.xml` and `/robots.txt` routes. Local SQLite shows zero test enquiries after the separate booking-phase browser verification.

### Deployment requirements and known deferred URLs

- Set `SEO_CANONICAL_URL=https://makemytroursandtravels.com` and `APP_URL=https://makemytroursandtravels.com` in production; review both before deploy. No credentials are involved.
- Verify production HTTPS and host redirects, robots/sitemap reachability and social previews after deployment.
- Category and email-derived author archives continue to return 404 and are omitted from the sitemap pending owner/Search Console/backlink disposition. `/blog/` is not an audited legacy URL.

## Phase 9: WordPress URL migration and redirects

Date: 2026-10-02

### Implemented

- Compared the audited legacy/current Laravel paths against `docs/SEO_URL_MAP.md`. The nine implemented page/post paths are unchanged, so no unnecessary redirect records were seeded.
- Added a server-side Laravel fallback redirect resolver for owner-approved active database mappings. Only permanent 301 records to registered local GET routes are followed; multi-hop rows resolve to the terminal target in a single response.
- Added protection against redirect loops, chains to dead/unregistered destinations, external/open redirect targets, path traversal, control characters, and non-301 database status values. Invalid mapping configurations are logged and return 404.
- Kept the unapproved category/author archive URLs and nonexistent `/blog/` path as 404 rather than inventing unrelated redirects.
- Created `docs/REDIRECTS.md` documenting preserved direct URLs, deferred paths, empty approved-mapping register, implementation, and verification.

### Files created

- `app/Http/Controllers/LegacyRedirectController.php`
- `tests/Feature/LegacyRedirectTest.php`
- `docs/REDIRECTS.md`

### Files modified

- `routes/web.php` — final fallback route for database-driven legacy mappings.
- `docs/DEVELOPMENT_LOG.md` — this phase record.

### Validation

- `php artisan test --compact --filter=LegacyRedirectTest` — passed: 5 tests, 25 assertions.
- `php artisan test --compact` — passed: 29 tests, 1,201 assertions. The full suite also confirmed the fallback remains a normal 404 when the optional redirect schema has not been migrated in an isolated test database.
- `vendor\bin\pint --test` — passed for changed PHP files; editor diagnostics reported no errors.
- Redirect feature tests cover 301 status and `Location`, live 200 target, single-hop response for a configured chain, loop/dead/external rejection, unchanged direct URLs and intentionally deferred 404s.
- No live database redirect mapping was created because the audited URL map identifies no approved changed URL.

## Homepage refinement

Date: 2026-10-02

### Implemented

- Refined the existing homepage in place; routes, shared layout, components, booking workflow, navigation and section order remain unchanged.
- Replaced the “Mumbai Explorations” copy and generated promotional claims with concise homepage wording about the verified bus/Tempo Traveller services and the sourced “since 2008” date.
- Removed unsupported traveller, tour and satisfaction counts. The trust strip now uses the sourced start year and existing vehicle/enquiry categories rather than unverified statistics.
- Removed unverified testimonial quotations. Kept the customer names and portraits displayed on the live site; review text was not readable in the available source-page render, so no replacement quotation was invented.
- Kept the live-listed car-rental service but made its description explicitly ask visitors to confirm current availability. Fleet cards do not claim unverified pricing, capacities or equipment.
- Refined the mobile hero height and title width while preserving its existing image, dark overlay, CTA behavior, booking panel and form fields. The existing responsive grids and footer were retained.
- Updated the design-system and homepage SEO records with the copy decisions, responsive findings, screenshot limitation and manual-review items.

### Files modified

- `resources/views/welcome.blade.php` — homepage metadata, H1, company/services/trust/fleet/CTA/testimonial copy.
- `resources/views/components/testimonial-card.blade.php` — optional review text so unverified quotations can be omitted without duplicate markup.
- `resources/css/app.css` — hero heading width and reduced mobile/tablet hero minimum heights; testimonial cards without quotations remain vertically balanced.
- `docs/DESIGN_SYSTEM.md` — current homepage tokens, refinements, responsive results and remaining screenshot/content approvals.
- `docs/SEO_REQUIREMENTS.md` — homepage H1/copy status, removed claims, metadata preservation and SEO recheck.
- `docs/DEVELOPMENT_LOG.md` — this refinement record.

### Validation

- `php artisan test --compact` — passed: 29 tests, 1,201 assertions.
- `npm run build` — passed with Vite 7.3.6.
- Local browser QA at 320px, 375px, 390px, 414px, 768px, 1024px, 1280px and 1440px — no horizontal overflow and no broken local images.
- Mobile navigation opened and closed with Escape. The booking form and backend behavior were not changed.
- SEO markup was preserved: unique title/description, canonical, Open Graph/Twitter metadata, one H1, image alt attributes and existing Organization/WebSite JSON-LD. No review/rating schema was added.
- The user-referenced original desktop/mobile screenshots were not accessible as separate files during this refinement. A final screenshot-to-screenshot comparison remains pending their availability; local browser visual review was performed instead.

## Homepage booking form visual update

Date: 2026-10-03

### Implemented

- Reworked the existing booking form component into the compact two-row layout from the live WordPress form: From, To, When, Time, Seat, and Submit.
- Kept the same POST endpoint, CSRF token, honeypot, field names used by the enquiry request, and database/mail workflow. Required contact information, optional email, vehicle preference, and trip notes are in a collapsed, accessible “Contact details” disclosure so they do not enlarge the default form.
- The contact disclosure opens automatically after backend contact-field validation errors and opens/focuses the first invalid contact input during browser-side validation.
- Capped and centered the form card width, reduced padding and field dimensions, retained the white/orange visual treatment, and set the desktop grid to three columns. Mobile/tablet layouts stack the fields and stretch the submit button to the available width.
- Matched the live WordPress field labels/placeholders where applicable. Its fourth trip field is labelled “Time” (not “Where”); the Laravel time input remains optional as required by its existing server-side rules.

### Files modified

- `resources/views/components/booking-form.blade.php` — compact trip fields and collapsed additional contact/details fields.
- `resources/css/app.css` — compact card, two-row desktop grid, field styling, overlap width and responsive stacked layout.
- `resources/js/app.js` — opens the contact disclosure when a required hidden contact field fails native form validation.
- `docs/DEVELOPMENT_LOG.md` — this record.

### Validation

- `php artisan test --compact --filter=BookingEnquiryTest` — passed: 6 tests, 56 assertions, including valid storage/email, invalid/empty submissions, honeypot, rate limit, mail failure, CSRF and route middleware.
- `npm run build` — passed with Vite 7.3.6.
- Local browser measurements at 320px, 375px, 390px, 414px, 768px, 1024px, 1280px and 1440px — no horizontal overflow or broken images. The desktop form uses three columns; the mobile/tablet form stacks in one column.
- Browser validation test: after trip fields were completed with contact details omitted, the disclosure opened and focus moved to the required name field; submission did not bypass required data.
- Visually checked the compact overlapping white card and its live-site field order against the current WordPress form. The existing Laravel route and SEO markup were not changed.

## Homepage visual structure migration

Date: 2026-10-03

### Implemented

- Kept existing routes, SEO metadata, section content, booking behavior and shared site architecture; adjusted the existing homepage DOM and scoped CSS rather than replacing the page.
- Right-aligned desktop hero content and retained left-aligned mobile content.
- Added a small overlapping existing vehicle image to the About visual for a collage treatment.
- Replaced the pale statistics strip with a two-part, edge-to-edge travel image and dark statistics/services panel. Kept the verified 2008 date and avoided unsupported customer/tour counts.
- Added compact calendar/bus/Tempo Traveller icons to the facts in the dark panel; they describe the sourced start year and the site's listed transport categories rather than fabricated totals.
- Preserved six service cards in a 3-column/two-row desktop arrangement and changed their numbered decoration to reusable bus icons; retained the highlighted service-card treatment.
- Changed the orange-only CTA into a full-width dark photographic travel banner using existing local bus and phone artwork.
- Added an existing local travel photo as a dark overlay background for the customer portrait section while retaining only the names/portraits visible on the live site (no unverified review text).
- Changed the blog teaser to a compact image-and-article card using an existing local image.
- Retained the existing dark shared footer and all existing URLs/internal links.

### Files modified

- `resources/views/welcome.blade.php` — visual structure for the About collage, split image/dark panel, full-width photographic CTA, testimonials background, and compact article image.
- `resources/views/components/service-card.blade.php` — optional reusable bus icon while retaining support for existing numbered card usage.
- `resources/views/components/stat-card.blade.php` — optional calendar and vehicle icons for the homepage fact panel.
- `resources/css/app.css` — hero positioning, image/panel split, card/icon styling, photographic CTA/testimonial backgrounds, compact blog layout and responsive stacking.
- `docs/DESIGN_SYSTEM.md` — homepage structure, responsive design record and image-reference limitations.
- `docs/DEVELOPMENT_LOG.md` — this phase record.

### Validation and remaining comparison

- Laravel feature suite — passed: 29 tests, 1,210 assertions.
- Vite build — passed; a temporary public-asset CSS URL warning was removed by rendering the local background assets as ordinary `<img>` elements.
- Browser QA across 320px, 375px, 390px, 414px, 768px, 1024px, 1280px and 1440px — no horizontal overflow or broken images; hero, split statistics, services, CTA, testimonials, article and footer remain in the requested order.
- The `old-theme.png` and `new-laravel.png` screenshot files were not available in the pasted-text attachment or workspace. Thus visual proportions/crops cannot be certified against those full-page references until the actual images are provided.
- Contact data and enquiry processing remain present, and SEO title, canonical, H1, JSON-LD, Open Graph/Twitter, sitemap and robots behavior were not altered.

## Bus collection section visual update

Date: 2026-10-03

### Implemented

- Updated only the existing homepage bus collection section, fleet card component/styles, the statically configured fleet display data, its focused feature assertions, and this documentation.
- Replaced the centered heading with a desktop header row: left eyebrow/title, explanatory text, and orange “All Vehicle” button linked to the existing `/bus-hire/` route.
- Changed each existing local-image fleet card to a large rounded image with a centered overlapping white panel, vehicle name, orange `₹00/day` reference display, divider, four vertically stacked icon-led specifications matching the live listing, “Book Now” anchor to the existing booking form and “View Details” link to the existing service page.
- Preserved the existing vehicle images and details routes; no route, model, migration, database record, booking endpoint or SEO markup was changed.
- The `vehicles` table is empty in the local development database. The current Vehicle model has a nullable seat-count field but no other specification or pricing fields. Display data follows the live WordPress cards: AC Bus (50 Seat, 2 Driver Staff, Manual, Fully Insured), Non-AC Bus (42 Seat, 2 Driver Staff, Manual, Fully Insured), and Tempo (12 Seat, 1 Driver Staff, Manual, Fully Insured). `₹00/day` is retained exactly as the reference placeholder and is not a real quote; confirm these details before launch.

### Files modified

- `resources/views/welcome.blade.php` — fleet display data and left/description/button section header.
- `resources/views/components/fleet-card.blade.php` — overlapping vehicle information panel, price/specifications, and distinct primary/secondary actions.
- `resources/css/app.css` — scoped collection header/card styling, image proportions/overlap, icon list, and responsive card grid.
- `tests/Feature/SiteFoundationTest.php` — homepage assertions for collection labels, reference data and links.
- `docs/DESIGN_SYSTEM.md` — collection design/data and screenshot comparison note.
- `docs/DEVELOPMENT_LOG.md` — this record.

### Validation and remaining visual comparison

- Feature tests and production Vite build passed.
- Browser checks at 320px, 375px, 390px, 414px, 768px, 1024px, 1280px and 1440px verified single-column mobile, two-column tablet, three-column desktop, overlapping cards, working enquiry/detail links, and no horizontal overflow or broken local vehicle images.
- The reference screenshot was described in the pasted text but was not supplied as an image file; direct pixel-level screenshot comparison remains pending. Public WordPress section labels/specifications and its placeholder rate were inspected in the live browser.

## About Company section visual update

Date: 2026-10-03

### Implemented

- Updated only the homepage About section composition, its scoped styling, feature coverage, and the design/development records.
- Reversed the desktop composition to copy on the left and image collage on the right, matching the live WordPress arrangement and its approximately 46px display heading.
- Added the locally stored primary bus/visitor image, reused the existing Mumbai travel image as the smaller white-framed overlap, and added a relative decorative shape and “15+ Years Experience” badge.
- Replaced the prior generic “Travel services from Mumbai since 2008” About copy with a brand-specific heading, sourced Mumbai-tour wording, and the existing About page CTA. The homepage H1, SEO metadata, schema, canonical, Open Graph, routes, and other sections were not changed.
- At widths up to 768px the image collage and badge precede the copy; the visual scales within the content column and the CTA remains linked to `/about/`.

### Files modified

- `resources/views/welcome.blade.php` — About section copy, heading, collage image markup, accessible image labels, badge, and existing CTA.
- `resources/css/app.css` — desktop columns, collage proportions/overlap, badge, typography, CTA treatment, and tablet/mobile ordering and sizing.
- `tests/Feature/SiteFoundationTest.php` — verifies About heading, collage assets, experience label, and CTA.
- `docs/DESIGN_SYSTEM.md` — records the About layout, imagery, badge, typography, and responsive behavior.
- `docs/DEVELOPMENT_LOG.md` — this record.

### Validation and remaining visual comparison

- Targeted About feature test passed (8 assertions); the full Laravel suite passed (30 tests, 1,233 assertions), and the production Vite build completed successfully.
- Browser QA at 320px, 375px, 390px, 414px, 768px, 1024px, 1280px, and 1440px confirmed the expected desktop/mobile order, both images load, and there is no horizontal overflow.
- The supplied original screenshot was not available as an image file in the workspace/chat attachment, so exact screenshot-to-screenshot pixel comparison remains pending. The desktop composition was instead matched to the inspected live WordPress layout and image geometry.
- Confirm the live “15+ Years Experience” claim with the business before launch.

## Why Choose Us section visual update

Date: 2026-10-03

### Implemented

- Reworked only the homepage Why Choose Us section and its reusable statistic card presentation.
- Replaced the Scania-only image with the matching family-and-coach image used by the live WordPress section. The image occupies the left half of the desktop split and connects directly to the black right panel.
- Added the orange overlapping “Travel with Make My Tours & Travels” callout and retained its booking action as an anchor to the existing homepage enquiry form.
- Updated the panel heading and description to match the live section, kept the section heading at H2, and arranged four orange-icon statistics as a 2×2 grid on desktop.
- Mirrored the public WordPress labels and values (15+, 5,000+, 1,000+, 8,000+). The live counter markup contains conflicting animation numbers; confirm these claims with the business before production.
- Mobile and tablet layouts place the image/overlapping CTA before the dark panel, use a 2-column metrics grid where space permits, and collapse metrics to one column on narrow phones.

### Files modified

- `resources/views/welcome.blade.php` — Why Choose Us image, overlapping CTA, heading/copy, and four metric cards.
- `resources/views/components/stat-card.blade.php` — orange bus/traveler/achievement/satisfaction icons and separate orange plus signs.
- `resources/css/app.css` — split layout, full-bleed family image, CTA overlap, dark panel, 2×2 metrics grid, and responsive behavior.
- `public/images/make-my-why-choose-us.png` — added the exact matching public WordPress image as a local asset.
- `tests/Feature/SiteFoundationTest.php` — assertions for section asset, text, CTA, four cards, and heading.
- `docs/DESIGN_SYSTEM.md` — section composition, metrics confirmation risk, and responsive behavior.
- `docs/DEVELOPMENT_LOG.md` — this record.

### Validation

- Targeted Why Choose Us feature test passed (13 assertions); full Laravel suite passed (31 tests, 1,248 assertions).
- Production Vite build completed successfully.
- Browser QA at 320px, 375px, 390px, 414px, 768px, 1024px, 1280px, and 1440px confirmed the full-width desktop split, image/CTA placement, 2×2 desktop metrics, mobile stacking, the one-column metrics grid at 320px, 2-column metrics from 375px upward, loaded local image, and no horizontal overflow.
- The supplied screenshots were not available as actual image files, so direct pixel comparison was unavailable. The matching live WordPress image, copy, and published metric labels/values were inspected in the browser. The live metric animation attributes conflict with the displayed fallback values; business confirmation remains necessary.

## Travel Comfortably CTA visual update

Date: 2026-10-03

### Implemented

- Updated only the existing homepage journey CTA section.
- Replaced the exterior fleet hero with the matching full-width bus-interior image used as the live WordPress CTA background, retaining a full-section dark overlay.
- Reordered the existing phone/ticket artwork to the left of the CTA copy on desktop and removed its separate image-box treatment.
- Matched the live eyebrow, orange-highlighted “Tours” heading, journey-planning description, and orange “Book Now” styling while preserving its existing telephone link.
- Desktop uses a centered two-column composition; mobile stacks the phone artwork above the content on the same full-width background.

### Files modified

- `resources/views/welcome.blade.php` — CTA background asset, phone image placement/alt text, matching heading and body, and button variant.
- `resources/css/app.css` — dark overlay, centered desktop grid, image proportions, typography/highlight, orange CTA button, and mobile stacking.
- `public/images/traveling-by-bus-interior.webp` — added the matching live WordPress bus-interior background.
- `tests/Feature/SiteFoundationTest.php` — verifies CTA assets, order, text, alt text, and retained telephone action.
- `docs/DESIGN_SYSTEM.md` — updated CTA layout and responsive design record.
- `docs/DEVELOPMENT_LOG.md` — this record.

### Validation

- Targeted CTA feature test passed (12 assertions); the full Laravel suite passed (32 tests, 1,257 assertions).
- Production Vite build completed successfully.
- Browser QA at 320px, 375px, 390px, 414px, 768px, 1024px, 1280px, and 1440px confirmed the cover background, loaded phone image, desktop two-column/mobile stacked order, retained telephone link, and no horizontal overflow.
- The phone artwork includes its own dark backdrop; screen blending lets the bus interior show through that dark area rather than framing the artwork in a separate box.
- The screenshots referenced in the pasted requirements were not provided as separate image files; the live WordPress section dimensions, copy, and matching public assets were inspected instead.
