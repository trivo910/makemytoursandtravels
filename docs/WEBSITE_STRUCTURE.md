# Website Structure Audit

Audit date: 2026-10-02

## Two different site states

The public site at `https://makemytroursandtravels.com/` is a WordPress site (homepage reports generator WordPress 7.0.6) with multiple sitemap URLs. The Laravel workspace currently serves only a custom one-page prototype at `/`. The local prototype is not evidence that the live site's inner-page content or behavior has been migrated.

## Public website pages and URLs

The WordPress page sitemap lists `/`, `/about/`, `/tempo-traveller-hire/`, `/bus-hire/`, `/urbania/`, `/our-standards/`, `/faqs/`, and `/contact/`. The post sitemap also lists `/hello-world/`; the category sitemap lists `/category/uncategorized/`; and the author sitemap lists `/author/makemytroursandtravels2080gmail-com/`. See `SEO_URL_MAP.md` for the full inventory and suggested handling.

The audited internal pages use the same primary menu: Home, About, Our Standards, Bus Hire, Urbania, Tempo Traveller Hire, FAQ's, Contact. The footer also contains generic links such as About Us, Services, Projects, Pricing, and Contact; several have no corresponding sitemap page and should not be treated as confirmed destinations.

## Production homepage

Observed top-to-bottom content:

1. **Header / navigation:** brand and “Trusted Travel Partner Since 2008” positioning; public phone CTA (`+91 77180 36300`); navigation to the seven listed inner pages plus home.
2. **Hero:** Mumbai travel positioning, “Get Started” and “Play Video” CTAs.
3. **Booking/search widget:** from/to selects, date, time and seat count with a submit button. The markup sampled has generic repeated field names and browser-visible “Input Invalid” text. The form uses GET to the homepage; the full booking/lead-processing outcome needs functional verification.
4. **About Company** and **Why Choose Us** content.
5. **Services:** Wedding Guests, Corporate Travelers, Private Travelers, Airport Shuttles, Tours & Excursions, Budget Car Rental.
6. **Booking CTA:** “Book Your Journey Today”.
7. **Fleet/bus cards:** three cards with visible `₹00/day` pricing placeholders in the sampled homepage, plus booking links/buttons. Confirmed fleet detail should come from the business owner, not the prototype.
8. **Testimonials:** customer names including Rahul Sharma, Purnima Thakur, Dhanesh Panchal and Priya Mehta appeared in image alt text; obtain approval/verification before reproducing testimonials or names.
9. **Other repeated conversion content** and a newsletter form.
10. **Footer:** contact/address, quick-link lists, newsletter, and shared site navigation. The public pages show `E-120, Puspanjali Bldg, Seven Bunglow, Andheri West, Mumbai`, `+91 77180 36300`, and `makemytoursplanner@gmail.com`.

The homepage image inventory included 13 `<img>` elements; multiple image alts are empty. The local preview instead uses remote Unsplash backgrounds and does not provide semantic `<img>` alternatives for those background images.

## Inner-page observations

- `/about/` has company history/introductory copy and images; its page title is specific, but the crawled head had no meta description.
- `/tempo-traveller-hire/`, `/bus-hire/`, `/urbania/`, `/our-standards/`, `/faqs/`, and `/contact/` returned HTTP 200 during the audit. In the sampled rendered text each had a page heading, followed by a repeated generic statement about reliable vehicles/fares/journeys and a mostly generic footer. Their names imply service, standards, FAQ, and contact detail, but the sampled content does not establish complete page-specific information.
- The inner-page shared footer includes the live business contact facts, newsletter signup, and generic links. The newsletter form posts as GET to `/` with a generic field name. The `/contact/` sample did not expose a dedicated enquiry form in the captured form list.
- `/hello-world/` is a WordPress starter blog post, “Hello world!”, and exposes a public comment form. It is not a substantive travel article.
- The uncategorized category and author archives are generated WordPress archive URLs, not confirmed curated landing pages.

## Header, footer, forms, and CTAs

- The live primary navigation routes to the production multi-page URLs in the URL map; a contact phone CTA is visible.
- Homepage CTAs include Get Started, Play Video, Book Your Journey Today, fleet booking actions, and newsletter signup.
- Booking form details and submission behavior are not proven end-to-end. Its form markup includes repeated generic names (`input-select`, `input-date`, `input-number`) and visible invalid-input messaging; verify validation, destination options, processing, notification, and consent.
- The newsletter input is present on homepage and inner pages; it uses a generic field name and GET submission to `/`. Confirm whether a subscription service is connected and whether consent/confirmation exists.
- The blog starter post has a comment form with name/email/URL/comment and cookie-consent checkbox.
- The local Laravel prototype has no `<form>` elements: destination/date/time selects and Submit are static controls; fleet “Book Now” controls are buttons without handlers; many links are `#`. Its footer contact details differ from production and look like demo values. Do not migrate these as facts.

## Local Laravel prototype sections

Current `GET /` renders one long Blade page:

- Hero/header with brand, six placeholder `#` menu links, Contact Us, heading, and Get Started/Explore More anchors.
- Static booking/search panel.
- About section, feature image, traveler/experience statistics.
- “Trusted Since 2008” promotional band with sample metrics.
- Four generic services: Corporate Travel, Wedding Guests, Private Travelers, Tour Packages.
- Travel Comfort promo with CSS-drawn phone/map artwork.
- Fleet cards: AC Bus, Non-AC Bus, Tempo; illustrative capacities/features and static Book Now buttons.
- Three testimonial cards with generic/sample copy.
- Three blog cards; one is titled “Hello world!” and the other two are generic placeholder article titles.
- Footer with placeholder social links, quick links, sample location/phone/email, newsletter copy and 2026 copyright.

All content and inline CSS live in `resources/views/welcome.blade.php`; the other Blade files are absent. No controller, content model, request handler, or frontend interaction is wired to these sections.

## Responsive behavior observed

- Local prototype checked at desktop (1440px viewport) and mobile (390px viewport): no horizontal document overflow was measured (document width 1425px at 1440, 375px at 390).
- The local CSS hides `.nav-links` at widths <=1100px and hides its header CTA at <=760px. No replacement mobile menu control is present in the Blade markup, so navigation becomes unavailable in the narrow layout.
- Local grid behavior: four service columns become two at <=1100px; most card/footer grids become two at <=1100px and one at <=760px; search fields become two columns at <=760px and one at <=520px.
- Live production page was also loaded at 390px and had no horizontal document overflow (375px document width measured). The live theme's navigation selector was not conclusively identified in that check; separately verify tap-menu behavior and all mobile forms on real target devices.
- Separate screenshot image files were not present in the workspace/chat; these are browser viewport observations, not a full image-by-image screenshot review.

## Images and content quality

- The Laravel prototype uses external Unsplash image URLs for hero, features, comfort imagery, fleet and blog cards; there are no local brand/fleet assets under `public/`.
- Live WordPress pages load media from the site's uploads and show multiple images, including blank alt text. Inventory original image URLs, ownership/licensing, descriptive alt text, responsive derivatives, and replacements before migration.
- Incomplete/demo content includes `Hello world!`, generic placeholder blog copy, prototype's fake contact details, unlinked `#` navigation/cards/social links, placeholder booking selectors, unsupported numeric claims (25k+, 2401 trips, 95%, 4.9, etc.), and production homepage fleet pricing shown as ₹00/day.
- Confirm all public claims, contact data, testimonials, prices, service availability, vehicle capacities, and dates with the business before carrying them forward.
