# Project Audit and Implementation Plan

Audit date: 2026-10-02

## Current state

The Laravel workspace is a fresh Laravel skeleton with a custom one-page Blade prototype. It is not yet a Laravel implementation of the live Make My Tours & Travels site.

- PHP CLI: 8.2.12; Composer: 2.10.1.
- `composer.json` requires PHP `^8.2` and Laravel `^12.0`; installed framework reports Laravel 12.69.3.
- `package.json` uses Vite 7, Tailwind CSS 4, Laravel Vite Plugin 2, Axios 1.11 and Concurrently 9. `composer.lock` is present; no npm lockfile was found.
- One app-authored web route exists: `GET /`, returning `resources/views/welcome.blade.php`. Laravel also registers its framework health and storage routes.
- There is one Eloquent model (`User`), the default Laravel migrations, and no travel, fleet, booking, blog, or CMS models/controllers.
- The local SQLite database has nine Laravel infrastructure tables: `migrations`, `users`, `password_reset_tokens`, `sessions`, `cache`, `cache_locks`, `jobs`, `job_batches`, and `failed_jobs`. All three migration files report as run.
- The Blade prototype holds almost all markup and CSS in one file. `resources/css/app.css` and the JavaScript entry are minimal; public assets consist of `index.php`, `.htaccess`, `robots.txt`, and a zero-byte favicon. Prototype photos and the Poppins font are remote third-party resources.
- No authentication or admin routes/UI are implemented. Laravel's default `User` model/auth configuration and user/password-reset tables exist, but they do not constitute a usable sign-in or admin feature.
- `.env` exists. Environment values/secrets were not copied into this audit. The tracked example config indicates local development defaults; production values, secret management, and deployment configuration still require owner review.
- Baseline `php artisan test --compact`: 2 tests passed (2 assertions). These are skeleton tests and do not demonstrate business functionality.

## Scope and evidence

Reviewed the Laravel source/configuration, dependency manifests, route list, migrations and SQLite schema metadata, environment key names (not values), public assets, and local page at desktop and 390px mobile viewport. Inspected the live website, its `robots.txt` and WordPress sitemap index/children, and sampled the sitemap URLs in-browser.

No standalone screenshot image files were attached in the workspace/chat. The shared local browser page was used as the available local visual reference; desktop/mobile observations in this audit are browser checks, not a review of separate supplied image files.

Production observations are a point-in-time audit, not a guarantee that third-party site content or behavior will remain unchanged.

## Recommended implementation order

1. **Confirm migration scope and authoritative business content.** Approve the final pages, service/fleet inventory, current contact details, claims/testimonials, booking workflow, and any actual mobile/desktop design references. Obtain any needed WordPress export/media files and analytics/Search Console data.
2. **Protect URL equity and plan migration.** Use `SEO_URL_MAP.md` to approve canonical destinations, keep equivalent URLs where possible, and determine redirects/noindex treatment for WordPress starter/archive URLs using traffic/backlink data.
3. **Establish Laravel foundations.** Confirm production PHP/runtime, database, mail, storage, queue, cache, deployment/security settings, and access requirements. Design domain schema and admin/auth scope before building it; do not expose admin functionality by assumption.
4. **Implement reusable layout and approved design system.** Build shared navigation/footer, accessible responsive components, local/managed imagery and typography, then the home page. Keep content, routes, and presentation separated.
5. **Implement high-value pages and conversion path.** Build Bus Hire, Tempo Traveller Hire, Urbania, About, Our Standards, FAQs, Contact, then booking/contact form handling and server-side validation/delivery.
6. **Implement content operations.** Add a blog only if it is in the approved scope; define editorial/admin workflows and intentionally handle the current `Hello world!` post and WordPress archives.
7. **Migrate/author content and media.** Validate facts and licenses, map image alt text, preserve metadata, and remove prototype/sample values and dead links.
8. **Verify SEO, accessibility, responsive behavior, and operations.** Test route/status/redirect matrix, metadata/schema, forms, mobile/keyboard/screen-reader behavior, performance, production asset loading, backups, logs, and monitoring before cutover.
9. **Cut over and monitor.** Freeze content, deploy with rollback plan, submit/verify sitemap, monitor 404s/indexing/conversions, and retain old URL/redirect mapping.

## Decisions needed before implementation

- Are the live production pages and current public contact details authoritative, or should any of the local prototype content/design take precedence?
- Which booking interaction is required (quote enquiry, date/vehicle request, payment/availability system)? The current app prototype does not implement booking.
- Is a protected admin/CMS required, and which roles/content types must it manage?
- Which WordPress content/media should migrate, be rewritten, redirected, or excluded?
- Confirm whether screenshots/design references are to be supplied; none were available as separate attachments during this audit.

## Audit-only boundary

No application code, database records/schema, or configuration values were changed. The six audit documents are the only intended deliverables.
