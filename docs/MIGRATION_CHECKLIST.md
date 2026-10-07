# WordPress-to-Laravel Migration Checklist

Audit date: 2026-10-02

This is a pre-implementation checklist based on the live WordPress site and the current Laravel skeleton. It does not assume that all WordPress content or all prototype content should be copied.

## 1. Decisions and source-of-truth

- [ ] Confirm public site/content source of truth and whether the current WordPress pages are authoritative.
- [ ] Obtain supplied desktop/mobile design screenshots or approve the available live/local browser references.
- [ ] Confirm current company name, Mumbai address, phone, email, service coverage, hours, vehicle types/capacities, real rates, terms, and operational promises.
- [ ] Verify testimonial identities/permissions and all numeric claims.
- [ ] Decide whether booking is a quote request, availability workflow, reservation/payment, or external handoff.
- [ ] Decide whether newsletter/blog/comment functionality is in scope.
- [ ] Define admin roles, permissions, audit trail, and required content types before adding auth/admin functionality.
- [ ] Obtain WordPress database/content export, uploads/media, redirect history, analytics, Search Console, and backlink/indexing evidence as applicable.

## 2. Route and SEO preservation

- [ ] Approve the legacy URL map in `SEO_URL_MAP.md`; retain `/`, `/about/`, `/tempo-traveller-hire/`, `/bus-hire/`, `/urbania/`, `/our-standards/`, `/faqs/`, and `/contact/` where possible.
- [ ] Decide `/hello-world/`, `/category/uncategorized/`, and `/author/makemytoursandtravels2080gmail-com/` disposition using traffic, backlinks, and indexed status.
- [ ] Create an explicit old-path → new-path/status/canonical matrix for every migrated or retired URL.
- [ ] Preserve title, description, canonical, indexability, useful headings, image alt text, links, and publish/update dates where content remains valid.
- [ ] Implement direct permanent redirects for approved URL changes; test no loops, chains, or irrelevant redirects.
- [ ] Plan sitemap and `robots.txt` launch state; do not accidentally ship a disallow-all policy or list utility/admin routes as indexable.
- [ ] Verify canonical HTTPS host and trailing-slash behavior at application/proxy/CDN layers.

## 3. Content and media

- [ ] Export and inventory WordPress page/post content, reusable blocks, FAQs, business facts, and internal links.
- [ ] Reconcile production contact details against business confirmation before publishing. Do not carry over the local prototype's sample phone/email/address.
- [ ] Replace placeholder `Hello world!`, generic demo articles, `#` destinations, unsupported stats/testimonials, and `₹00/day` display with approved content or remove them.
- [ ] Map every production image/media URL to a retained licensed local asset or approved replacement; retain credit/license records.
- [ ] Generate responsive optimized image variants; add meaningful alt text to informative images and empty alt to decorative images.
- [ ] Confirm currency, units, service areas, dates, capacity/rates, and mobile-visible copy.
- [ ] Add redirects or update internal references for migrated media URLs if old links must continue to work.

## 4. Laravel application foundations

- [ ] Confirm deployment PHP version against the Composer constraint (PHP `^8.2`) and Laravel 12 support/security policy at launch.
- [ ] Select production relational database, schema migration/backup strategy, connection secrets, and least-privilege DB account; current local SQLite is a starter setup.
- [ ] Define models/migrations for approved content and business workflows. Current DB has only Laravel user/session/cache/queue structures, no travel-domain entities.
- [ ] Decide whether to use an existing CMS/admin package or custom workflow; implement only approved authentication, authorization, password reset, and admin routes.
- [ ] Configure production `APP_ENV`, `APP_DEBUG=false`, secure `APP_KEY`, HTTPS/proxy/session/cookie settings, mail delivery, queue/cache, storage, logs, and backups. Never commit `.env` or secrets.
- [ ] Lock Node dependencies and choose reproducible CI/build versions. Current `package.json` has no npm lockfile in the workspace.
- [ ] Separate Blade layout/components, route/controller/request validation, content, CSS, and JavaScript; avoid putting the full site in one inline-style Blade view.
- [ ] Build production assets using Vite and remove/replace remote prototype imagery/font dependencies intentionally.

## 5. Forms and user journeys

- [ ] Define booking fields, business rules, service coverage, validation, data retention, consent, spam protection, notification/CRM integration, and failure handling.
- [ ] Give fields stable semantic names and labels; current prototype selectors have no names/action handler, and the observed WordPress widget uses repeated generic names.
- [ ] Implement secure server-side validation and CSRF protection; escape user-provided output and avoid exposing submitted contact data in URLs/logs.
- [ ] Verify success/failure and duplicate-submission states, notifications, phone/email actions, and keyboard/screen-reader feedback.
- [ ] Confirm contact and newsletter submission destination/retention/unsubscribe behavior. Do not represent a static button as working functionality.

## 6. Testing and launch

- [ ] Add route feature tests for all approved pages, response codes, redirects, custom 404, canonical/meta output, and form handling.
- [ ] Add content/schema tests for required title/description/H1/canonical and accurate structured data on indexable pages.
- [ ] Test desktop/tablet/mobile layouts, menu behavior, 320px–wide screens, keyboard navigation, touch targets, contrast, and reduced motion.
- [ ] Check image/font/JS/CSS requests, broken links, form delivery, mail queue, production logs, and accessibility/performance.
- [ ] Crawl the staging host and reconcile results with the full legacy URL matrix before launch.
- [ ] Back up WordPress content/database/media and Laravel production DB/files; rehearse rollback and DNS/CDN/cache plan.
- [ ] Freeze content, deploy, verify HTTPS, redirects, sitemap, robots, canonical pages, forms, and analytics immediately after cutover.
- [ ] Monitor Search Console coverage, 404s, redirects, rankings, traffic, and conversion events; keep the approved redirect map available.

## Confirmed baseline tests

`php artisan test --compact` passed its two existing skeleton tests (two assertions). Functional migration requirements remain untested until corresponding Laravel functionality and domain-specific tests exist.
