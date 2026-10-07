# Database Structure

## Current phase

This phase adds an append-only content and enquiry schema to the existing Laravel 12 application. Existing Laravel `users`, sessions, cache, queue, and migration tables are retained. No existing migration was edited and no existing table is dropped or renamed. The four new migrations have now been applied to the configured local SQLite development database.

Before migration, the local SQLite database contained two session rows and no content records. The migration status was checked first; all four additive migrations ran successfully, preserving those sessions. A synthetic browser submission verified local storage and was removed afterward; the booking enquiry table is empty. Automated schema and relationship tests use isolated in-memory SQLite. Review a backup and the target connection before applying these migrations to any other persistent development, staging, or production database.

## Tables

| Table | Purpose and principal fields | Relationships |
|---|---|---|
| `pages` | Editorial pages: title, unique legacy-compatible slug, excerpt, body, publish state/date, sort order | Has one polymorphic SEO record; has FAQs |
| `services` | Reusable service catalogue: name, unique slug, summary, description, image path, active state and order | Many-to-many vehicles; has FAQs; has one SEO record |
| `vehicles` | Fleet catalogue: name, unique slug, type, description, optional image and optional seat count, active state and order | Many-to-many services; has booking enquiries; has one SEO record |
| `service_vehicle` | Unique service/vehicle assignments | Belongs to one service and one vehicle; cascades when either catalogue row is deleted |
| `testimonials` | Customer attribution, quote, optional rating and publish/feature/order flags | Independent content; publishing scope excludes drafts |
| `faqs` | Question/answer with optional page and/or service association, publish state and order | Belongs to a page and/or service; parent deletion sets the association to null |
| `blog_categories` | Named, uniquely slugged article categories | Has many blog posts |
| `blog_posts` | Article title, unique slug, excerpt/body, featured image, draft/published/archived status and publication time | Optional category and author; one polymorphic SEO record |
| `seo_metadata` | One-to-one polymorphic title, description, canonical, focus keyword, OG/Twitter, robots and JSON-LD data | Unique `(seoable_type, seoable_id)`; currently intended for pages, services, vehicles and posts |
| `contact_enquiries` | Contact form name, optional email/phone, subject/message and workflow status | Independent enquiry record |
| `booking_enquiries` | Trip request contact, pickup/destination, date/time, passenger count, optional vehicle preference/record and workflow status | Optional vehicle record; vehicle deletion sets the reference to null |
| `redirects` | Unique source path, destination URL, HTTP status and active flag | Independent SEO routing data |
| `roles` | Extensible named/slugged user role catalogue | Many-to-many users |
| `role_user` | Unique role/user assignments | Cascades on role or user deletion |

The new schema intentionally does not add a generic settings table, permission/ACL tables, tags, availability/pricing inventory, or a second page-to-service join. Those features have no confirmed current data/workflow requirement.

## Models and behavior

Models live under `app/Models`. Slugs are unique at the database layer. Publication scopes are provided for pages, testimonials, FAQs, and blog posts; blog posts are visible through the scope only when published and their publication time has arrived. SEO JSON-LD is cast to an array. Nullable catalogue associations use `nullOnDelete` where enquiries or content should be retained.

`User` has many-to-many `roles()`, authored `blogPosts()`, and a `hasRole($slug)` helper. The idempotent `RoleSeeder` registers `admin` and `editor`; it does not create or grant an administrator account. The default `DatabaseSeeder` no longer creates a predictable `test@example.com` login. No admin routes, login workflow, middleware, policies, or CMS screens exist yet. Those must be implemented with authorization policies and protected routes before assigning roles to real users.

`StoreContactEnquiryRequest` and `StoreBookingEnquiryRequest` centralize validation. The homepage booking form POST is connected to `BookingEnquiryController`, stores only validated fields, and sends `BookingEnquiryReceived` to the configured booking address. Its trip fields include contact name/phone/email, pickup/destination, date/time, passenger count, vehicle preference and optional notes. Server validation restricts vehicle preference to known options and restricts an optional related vehicle record to active fleet records. The route uses the web middleware group (including CSRF protection), a five-submissions-per-ten-minutes throttle and a hidden honeypot.

The booking notification recipient is configured with `MAIL_BOOKING_TO` (the current public business contact email is the non-secret default). Mail transport credentials remain in deployment environment configuration and must never be committed. The example local mailer logs mail rather than delivering it; configure a real transport before production. If delivery fails after storage, the form reports that the enquiry was saved and asks the customer to call, while the server log records the failure without logging message contents.

The contact request Form Request remains prepared for a future contact submission endpoint; the contact page does not yet persist its own message form.

## Data safety and operations

- All schema additions use new migrations; rollback methods target only their own newly created tables and respect foreign-key order.
- Do not use `migrate:fresh`, `db:wipe`, or destructive migration commands against a database containing data.
- Back up persistent databases and inspect `php artisan migrate:status` plus the configured connection before applying pending migrations.
- Run the automated tests with the configured `:memory:` SQLite connection to validate schema and relationships without changing the local SQLite file.
- Enquiries contain personal contact/trip data. Define access controls, retention/deletion policy, transport protection, consent/notice, anti-spam controls and secure backups before accepting or retaining production submissions.
- Editorial body fields are trusted CMS content; a future editor must sanitize allowed HTML before rendering it.
- Do not populate optional fleet specifications, testimonials, ratings or SEO claims without business verification and permission.

## Migration inventory

- `2026_10_02_000001_create_content_tables.php`
- `2026_10_02_000002_create_blog_tables.php`
- `2026_10_02_000003_create_seo_enquiry_and_redirect_tables.php`
- `2026_10_02_000004_create_role_tables.php`

All migrations depend only on Laravel's existing users table and tables created earlier in this sequence.
