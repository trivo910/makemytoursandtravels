# WordPress-to-Laravel Redirect Register

Audit/source of truth: [`SEO_URL_MAP.md`](./SEO_URL_MAP.md)  
Migration date: 2026-10-02

## Approved changed URLs

The audited WordPress content URLs retain their original paths in Laravel. No approved old-to-new path changes were identified in the URL map, so **no production redirect records are required at this time**. Unchanged URLs are served directly; they are not sent through unnecessary redirects.

| Old URL | New URL | Status | Reason |
|---|---|---:|---|
| None identified | — | — | All implemented sitemap page/post paths remain unchanged. |

## Preserved URLs (direct 200; no redirect)

| URL | Laravel result |
|---|---|
| `/` | Homepage |
| `/about/` | About page |
| `/our-standards/` | Standards page |
| `/bus-hire/` | Bus Hire page |
| `/urbania/` | Urbania enquiry page |
| `/tempo-traveller-hire/` | Tempo Traveller page |
| `/faqs/` | FAQ page |
| `/contact/` | Contact page |
| `/hello-world/` | Substantive travel article at the original legacy post path |

These paths were checked as direct successful responses; the redirect table contains no entries for unchanged paths.

## Deferred legacy URLs

| Old URL | Current result | Disposition |
|---|---:|---|
| `/category/uncategorized/` | 404 | No approved relevant replacement in the source map. Keep out of the sitemap; decide after Search Console/backlink review. |
| `/author/makemytoursandtravels2080gmail-com/` | 404 | No approved replacement in the source map. Keep out of the sitemap; decide after Search Console/backlink review. |
| `/blog/` | 404 | The audited WordPress sitemap contained no blog index; do not invent a redirect target. |

Do not redirect these paths to the homepage or to an unrelated page. If search-index/backlink evidence leads to an approved disposition, update this register and the URL map with the exact old and new paths before deployment.

## Redirect implementation

Unmatched GET/HEAD URLs are checked against the existing `redirects` table by the final Laravel fallback route. Only active `301` records with safe local absolute paths are eligible. Redirect chains are resolved to the final registered route and emitted as one 301 response to the configured canonical origin; loops, unknown destinations, external/open-redirect targets and invalid status codes return 404 and are logged. This keeps redirects server-side and avoids client-side or temporary redirects.

No default redirect seeding is performed. Populate the table only with owner-approved mappings. Before applying a batch, confirm every destination returns 200 and is not itself redirected, and recheck for loops after each change.

## Verification record

- All nine preserved indexable URLs return 200 directly; no redirects are added for unchanged slugs.
- Feature tests verify an approved changed path returns 301, its destination returns 200, a configured multi-hop mapping collapses to one 301, and loops/dead/unsafe targets return 404.
- Unknown paths and unapproved category/author archives remain 404.
- No production mappings were inferred from the archive URLs or the lack of a `/blog/` index.
