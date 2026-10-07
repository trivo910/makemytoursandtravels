# Homepage Design System and Refinement Record

Updated: 2026-10-02

## Reference status

- The live Make My Tours & Travels homepage was reviewed as the source for its section order, live service labels, vehicle categories, and customer names.
- The original desktop and mobile screenshots referenced in the request were not available as separate files in the workspace or current chat attachments. The browser viewport was used for local responsive checks; pixel-perfect comparison to those screenshots remains a manual review item.
- The live WordPress page did not expose readable customer review text in the available browser render. Unverified review quotations have therefore been removed rather than presented as genuine.

## Shared visual tokens

Tokens are defined in `resources/css/app.css` and shared by the homepage and other pages.

| Token / attribute | Current value or pattern |
|---|---|
| Brand/accent | Orange `#f57d2b`, deep orange `#b94c09`, soft accent `#ffe7d5` |
| Background/surfaces | Page `#f4f3f1`, white panels, pale card `#f8f6f4` |
| Text | Dark `#111315` / `#1b1b1b`; muted `#626262` |
| Dark surfaces | `#111315`, `#1c1f22` |
| Typography | Poppins-first system font stack; no remote font dependency |
| Shape | Rounded cards/panels and pill CTAs; shared border and shadow tokens |
| Layout | Centered max-width 1220px container; responsive CSS grids |
| Imagery | Locally served, dimensioned hero, company, CTA, and vehicle assets |
| Interactions | Orange primary CTA, visible focus, reduced-motion support, subtle card hover |

## Homepage refinement

- The homepage order is header, hero, compact overlapping booking form, about/welcome, split image-and-dark statistics panel, services, full-bleed CTA, bus collection, photographic testimonials, compact blog guide, and shared footer.
- Desktop hero copy is right-aligned over the existing local Mumbai fleet image. The mobile layout returns to left alignment; the existing heading and CTAs remain in place.
- The booking form remains the existing validated Laravel form and keeps its server-side storage, notification, CSRF, spam controls, and field set. At narrow widths, fields stack in one column; tablet layouts use two columns.
- The About section places the company copy on the left and a two-image Mumbai travel collage on the right at desktop widths. Its primary bus/visitor image, overlapping framed secondary image, decorative backing shape, orange-accented experience badge, underlined heading treatment, and CTA follow the live WordPress arrangement. The “15+ Years Experience” badge mirrors the live design; confirm the public claim with the business before launch.
- The Why Choose Us section is a full-bleed desktop split with the matching family-and-coach image on the left and a dark panel on the right. An orange Book Your Tour card overlaps the lower image area; the panel contains a left-aligned trust heading, source-site description, and four icon-led metrics in a 2×2 grid. Its four numeric values mirror those currently published by WordPress, but its animation metadata contains conflicting alternate values; confirm all statistics with the business before publication.
- The six service cards remain in a three-column desktop grid (two rows), with circular bus icons and a restrained orange highlight on one card.
- The “Book Your Journey Today” CTA is a full-width darkened bus-interior banner with the phone/ticket artwork on the left and vertically centered copy on the right at desktop widths. It uses the original orange-highlighted heading treatment, source-site journey description, and an orange Book Now action that retains the existing telephone link. At mobile widths the phone image stacks above the copy over the same cover background.
- Testimonials use the same available local travel image as a dark background; only live-site customer names and portraits remain because their review text was not verified.
- The fleet cards retain existing local images, and the blog teaser uses an existing local travel image in a compact article layout. The shared footer already has a dark surface and remains in place.
- The About collage uses the locally stored primary live-site image and the existing secondary project image. Informative images have descriptive alt text; the decorative shape is hidden from assistive technology.
- Fleet cards retain the existing local imagery and avoid unverified capacities, pricing, or vehicle claims.
- Review quotations that could not be verified were removed. Customer names/portraits shown by the live page are retained; confirm identity/permission and obtain approved review text before publishing quotations.
- Generic “Mumbai Explorations” copy and unsupported descriptions were replaced with cautious, trip-enquiry wording. Car rental remains listed because it appears in the live service list; current availability should be confirmed with the business.
- Footer layout and published contact details were left unchanged; reconfirm business NAP details before launch.

## Responsive and accessibility behavior

- The shared header switches to its functional mobile drawer at the existing breakpoint. Drawer open/close and Escape behavior were rechecked.
- Homepage layout was measured at 320, 375, 390, 414, 768, 1024, 1280, and 1440 CSS pixels. No document horizontal overflow or failed local images were found.
- The form, service grid, CTA, vehicle cards, testimonials, blog teaser, and footer have breakpoint-specific stacking/column rules.
- At tablet/mobile widths, the About collage moves above the copy, retains the overlapping inset and badge, and scales within the content container.
- At tablet/mobile widths, the Why Choose Us image and orange CTA stack before the dark panel; the metrics switch to two columns and collapse to one at the narrowest phone widths.
- The journey CTA preserves the full-width bus-interior background and overlay while stacking the phone artwork before its heading, text, and call action on mobile.
- Informative images have descriptive alt text; decorative images remain empty-alt. Heading and button semantics, visible focus, and reduced-motion styles remain in place.

## Outstanding visual confirmation

- The `old-theme.png` and `new-laravel.png` names were mentioned in the supplied text, but those image files were not included with the text attachment or available in the workspace. Exact screenshot-to-screenshot comparison of hero crop, spacing, images, and proportions remains pending.
- Existing local assets are reused for all added image treatments. Confirm them against `old-theme.png` when it is available and replace only with the matching approved project asset.
- Verify testimonial permissions and live availability of the car-rental service before production publication.

## Bus collection section refinement

- The fleet section now has a left-aligned title/eyebrow, description and orange “All Vehicle” link on the same desktop header row.
- AC Bus, Non-AC Bus and Tempo cards use the existing local images, equal-width grid, large rounded image and centered white information panel overlapping its lower edge.
- Card panels contain the vehicle title, orange `₹00/day` reference display, divider, four vertically listed icon specifications (matching the live reference), primary “Book Now” link to the existing enquiry form, and text-style “View Details” link to the existing service URL.
- The public WordPress fleet listing rendered `₹00/day` and these specifications: AC Bus (50 Seat, 2 Driver Staff, Manual, Fully Insured), Non-AC Bus (42 Seat, 2 Driver Staff, Manual, Fully Insured), Tempo (12 Seat, 1 Driver Staff, Manual, Fully Insured). The local `vehicles` table has no rows and the model only stores nullable seat count, so the visible WordPress values are represented in homepage view data, not treated as verified database/admin data. The zero fare is a placeholder, not a real quote; confirm all specifications and rates before launch.
- At desktop widths cards are arranged in one row; tablet uses two columns; narrow mobile stacks the header and cards, while retaining the image-overlap panel and readable actions.
- The reference screenshot image itself was not attached as an image file with the pasted requirements. Current public WordPress text and existing live asset/category details were inspected; exact screenshot pixel comparison remains pending.
