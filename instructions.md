# Custom WooCommerce Theme — AI Coding Agent Instructions

## 0. Mission

Build a production-quality custom WordPress + WooCommerce theme from scratch for a premium home-decor ecommerce brand.

The store will launch with approximately 3–5 products and expand over time. The architecture must therefore be intentionally simple at launch but structurally capable of supporting hundreds or thousands of products without a rewrite.

The site must be:

- Beautiful and premium
- Modern and editorial
- Fast and Core Web Vitals focused
- Mobile-first
- SEO-first
- Accessible
- Secure
- Conversion-focused
- WooCommerce-native
- Maintainable
- Easy to extend

This is **not** a generic WordPress theme and must not look like a marketplace theme.

Do not use Elementor, Divi, WPBakery, Visual Composer, or another page builder.

Do not use Bootstrap.

Do not introduce a frontend framework unless a specific requirement genuinely justifies it.

Prefer native WordPress, WooCommerce, modern CSS, and lightweight vanilla JavaScript.

---

# 1. Non-Negotiable Rules

These rules apply throughout the project.

## 1.1 Never modify WordPress core

Never edit files belonging to WordPress core.

## 1.2 Never modify WooCommerce plugin files

Never edit WooCommerce plugin source.

Use:

- hooks
- filters
- template overrides
- supported APIs
- WooCommerce blocks/extensions where appropriate

## 1.3 WooCommerce owns commerce

WooCommerce remains the source of truth for:

- Products
- Variations
- Inventory
- Orders
- Customers
- Coupons
- Taxes
- Shipping
- Payments
- Refunds
- Reviews

Do not create parallel product/order/payment systems.

## 1.4 Payment processing must not live in the theme

The theme may style and integrate payment UI, but it must never implement card/UPI payment processing itself.

Use a proper WooCommerce-compatible payment gateway.

Examples include:

- Razorpay
- Cashfree
- PayU
- PhonePe
- another appropriate WooCommerce-compatible gateway

The exact provider can be configured later.

## 1.5 Never trust user input

Sanitize input.

Validate input.

Escape output.

Use WordPress nonces for custom state-changing requests.

## 1.6 Never sacrifice functionality for Lighthouse points

Optimize for real-world Core Web Vitals and user experience.

Do not perform pointless hacks solely to increase an artificial score.

## 1.7 Do not over-engineer the initial catalog

The store has 3–5 products initially.

Build a correct ecommerce foundation, but do not build enterprise functionality that is not required.

---

# 2. Product / Brand Design Direction

The store sells home decor.

The visual direction is:

**Modern + Warm + Premium + Minimal + Editorial**

The site should feel closer to a premium design/lifestyle brand than a typical ecommerce template.

Visual characteristics:

- generous whitespace
- large photography
- sophisticated typography
- neutral warm palette
- subtle borders
- subtle shadows
- restrained rounded corners
- restrained glass effects
- very subtle gradients
- elegant hover states
- clear CTAs
- strong visual hierarchy

Avoid:

- neon colors
- excessive gradients
- excessive glassmorphism
- excessive rounded cards
- giant shadows
- clutter
- unnecessary animations
- generic Bootstrap styling
- marketplace-style UI
- excessive badges
- excessive popups
- heavy visual libraries

The design should communicate quality without trying too hard.

---

# 3. Development Workflow

Do not immediately generate the entire theme in one pass.

Work in phases.

## Phase 1 — Discovery and architecture

Before writing substantial code:

1. Inspect the existing repository.
2. Identify whether WordPress/WooCommerce already exists.
3. Inspect existing theme/plugin files if present.
4. Identify the PHP version and WordPress/WooCommerce versions where available.
5. Propose the theme architecture.
6. Define the design token system.
7. Define the WooCommerce integration strategy.
8. Define the SEO strategy.
9. Define the performance strategy.
10. Define the UPI/payment strategy.

Do not delete existing work without explicit justification.

---

# 4. Phase 2 — Create the Theme Foundation

Create:

```text
theme/
├── style.css
├── functions.php
├── index.php
├── front-page.php
├── home.php
├── page.php
├── single.php
├── archive.php
├── search.php
├── 404.php
├── header.php
├── footer.php
├── screenshot.png
│
├── assets/
│   ├── css/
│   │   ├── tokens.css
│   │   ├── base.css
│   │   ├── layout.css
│   │   ├── components.css
│   │   ├── utilities.css
│   │   └── woocommerce.css
│   │
│   ├── js/
│   │   ├── main.js
│   │   ├── navigation.js
│   │   ├── cart.js
│   │   └── product.js
│   │
│   └── images/
│
├── inc/
│   ├── setup.php
│   ├── enqueue.php
│   ├── performance.php
│   ├── security.php
│   ├── seo.php
│   ├── template-functions.php
│   ├── template-hooks.php
│   └── woocommerce.php
│
├── template-parts/
│   ├── header/
│   ├── footer/
│   ├── content/
│   ├── product/
│   └── components/
│
└── woocommerce/
    ├── archive-product.php
    ├── single-product.php
    ├── content-product.php
    ├── cart/
    ├── checkout/
    └── myaccount/
```

Adjust this structure if a better architecture is justified, but maintain separation of concerns.

---

# 5. Theme Bootstrap

`functions.php` should remain small.

It should primarily load modular files.

Example architecture:

```php
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/performance.php';
require_once get_template_directory() . '/inc/security.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-hooks.php';
require_once get_template_directory() . '/inc/woocommerce.php';
```

Do not allow `functions.php` to become a 2,000-line file.

---

# 6. WordPress Theme Setup

Implement proper:

- title-tag support
- post thumbnails
- HTML5 markup support
- custom logo
- custom background if genuinely useful
- menus
- widgets only where useful
- editor styles if useful
- translation support

Use a unique theme text domain.

All user-facing strings must be translation-ready.

Use:

```php
__()
_e()
esc_html__()
esc_html_e()
esc_attr__()
```

appropriately.

---

# 7. Design Tokens

Centralize design decisions.

Create CSS variables for:

- colors
- typography
- spacing
- radii
- shadows
- container widths
- transitions
- breakpoints where appropriate

Example:

```css
:root {
    --color-bg: #faf9f6;
    --color-surface: #ffffff;
    --color-text: #1d1d1b;
    --color-muted: #6f6f6a;
    --color-border: #e6e2da;
    --color-primary: #303a32;
    --color-accent: #9a7b5a;

    --container: 1240px;

    --radius-sm: 8px;
    --radius-md: 14px;
    --radius-lg: 22px;

    --shadow-sm: 0 4px 18px rgba(0,0,0,.05);
    --shadow-md: 0 14px 45px rgba(0,0,0,.08);

    --ease: cubic-bezier(.2,.7,.2,1);
}
```

Use the actual brand palette if one is supplied.

Do not hard-code colors throughout the stylesheet.

---

# 8. Typography

Use a premium editorial typographic system.

Requirements:

- WOFF2 where self-hosting
- only required weights
- `font-display: swap`
- responsive typography
- strong hierarchy

Use `clamp()`.

Example:

```css
h1 {
    font-size: clamp(2.5rem, 6vw, 5.5rem);
}
```

Do not preload every font.

Only preload fonts that are truly critical to above-the-fold rendering.

---

# 9. Header Architecture

Build a responsive premium header.

Desktop concept:

```text
[LOGO]

Shop     Collections     About     Contact

                         Search   Account   Cart
```

Mobile concept:

```text
[Menu]      [Logo]      [Cart]
```

Requirements:

- sticky header
- accessible navigation
- keyboard navigation
- visible focus states
- mobile drawer
- cart count
- search
- account
- no unnecessary libraries

Use lightweight vanilla JavaScript.

The mobile menu must not block the page unnecessarily.

---

# 10. Homepage Architecture

Homepage should be composed from reusable sections.

Recommended structure:

1. Announcement bar — optional
2. Header
3. Hero
4. Featured products
5. Brand story
6. Collections/categories
7. Editorial/value section
8. Trust indicators
9. Newsletter
10. Footer

Do not make every section editable through dozens of custom fields.

Prefer sensible defaults and reusable components.

---

# 11. Hero

Hero must be visually strong.

Example:

```text
Beautiful Objects.
Thoughtfully Chosen.

Curated decor designed to make
your space feel like home.

[Explore Collection]
```

Hero requirements:

- responsive image
- explicit dimensions
- optimized image format
- correct `srcset`
- correct `sizes`
- no layout shift
- above-the-fold LCP image must not be lazy-loaded
- minimal JavaScript

Do not use a video background unless explicitly requested.

---

# 12. Product Grid

Create a reusable product grid component.

Desktop:

```text
4 columns
```

Tablet:

```text
2–3 columns
```

Mobile:

```text
2 columns where product imagery remains usable
```

Product cards should contain:

- image
- product name
- short descriptor if available
- price
- sale price
- sale state where applicable
- add to cart
- product link

Avoid clutter.

---

# 13. Product Card Rules

Use WooCommerce data.

Do not manually duplicate product pricing logic.

Support:

- regular price
- sale price
- variable products
- out of stock
- featured products
- sale products

Use WordPress/WooCommerce generated image sizes.

Avoid loading original high-resolution images into grids.

If a secondary image is used for hover:

- ensure it exists
- use an appropriate image size
- do not load unnecessary assets

---

# 14. Shop / Archive

The shop must use native WooCommerce architecture.

Support:

- sorting
- pagination
- categories
- product cards
- sale states
- stock states
- empty states

Do not build a custom product query if WooCommerce already provides the required query.

Use appropriate WooCommerce hooks.

---

# 15. Single Product Page

This is the primary conversion page.

Structure:

```text
Breadcrumbs

Product gallery      Product information

                     Product title
                     Rating
                     Price
                     Short description
                     Stock
                     Variations
                     Quantity
                     Add to Cart
                     Buy Now
                     Shipping information
                     Payment information

Description
Specifications
Shipping & Returns
Reviews
Related Products
```

Must support:

- simple products
- variable products
- variations
- quantity
- stock
- sale pricing
- reviews
- related products
- upsells
- cross-sells

Do not break WooCommerce hooks.

---

# 16. Product Gallery

Optimize heavily.

Requirements:

- responsive images
- thumbnails where appropriate
- mobile swipe
- optional zoom
- explicit dimensions
- no CLS
- minimal JavaScript

Do not load a large gallery library unless genuinely necessary.

Prefer CSS + vanilla JS.

---

# 17. Cart

Build a polished cart.

Include:

- image
- product
- quantity
- price
- remove
- subtotal
- coupon
- shipping
- total
- checkout CTA

An AJAX mini-cart may be implemented.

Do not make the entire cart dependent on custom AJAX if standard WooCommerce behavior is more reliable.

---

# 18. Checkout

Checkout should be distraction-free.

Prioritize:

1. Customer details
2. Shipping
3. Payment
4. Order review
5. Confirmation

Do not remove required WooCommerce hooks.

Do not break:

- payment gateways
- tax calculations
- shipping calculations
- coupons
- checkout validation
- WooCommerce Blocks where applicable

---

# 19. UPI Payment Architecture

The business is based in India and must support UPI.

Preferred architecture:

```text
Customer
    ↓
WooCommerce Checkout
    ↓
WooCommerce Payment Gateway
    ↓
UPI / Payment Provider
    ↓
Provider Verification / Webhook
    ↓
WooCommerce Order Status
```

Potential providers:

- Razorpay
- Cashfree
- PayU
- PhonePe
- another WooCommerce-compatible provider

The theme must only provide styling/integration support.

The theme must never:

- collect UPI PIN
- collect bank credentials
- store payment credentials
- mark orders paid based on a customer button click
- trust a client-side "payment successful" flag

---

# 20. UPI QR / Scanner UI

If the business wants a QR-based UPI option, support a clean UI such as:

```text
Pay with UPI

[ QR CODE ]

Scan using any supported UPI app

or

[ Pay with UPI ]
```

Important:

A static QR code is not a payment verification system.

If a static QR is used, there must be a reliable payment reconciliation process.

Prefer a gateway-generated payment/QR flow whenever possible.

Payment completion must be verified server-side through the provider/webhook.

---

# 21. Security

Follow WordPress security best practices.

Use:

```php
esc_html()
esc_attr()
esc_url()
wp_kses_post()
sanitize_text_field()
sanitize_email()
absint()
```

as appropriate.

For custom state-changing operations use:

```php
wp_nonce_field()
check_admin_referer()
wp_verify_nonce()
```

Do not trust:

```php
$_GET
$_POST
$_REQUEST
```

Never expose:

- API keys
- payment secrets
- credentials
- internal server details

Never put secrets in the theme.

---

# 22. SEO Architecture

SEO is a core architectural requirement.

Essential content must be server-rendered.

Do not require JavaScript for:

- product names
- product descriptions
- pricing
- category content
- navigation
- internal links
- important headings

Support compatibility with:

- Yoast SEO
- Rank Math
- SEOPress

Do not duplicate SEO plugin functionality.

If an SEO plugin generates:

- canonical
- schema
- title
- meta description
- Open Graph

the theme should not generate conflicting duplicates.

---

# 23. Structured Data

Support appropriate structured data through WooCommerce and SEO plugins.

Potential entities:

- Organization
- WebSite
- Product
- Offer
- Review
- AggregateRating
- BreadcrumbList

Never generate fake:

- reviews
- ratings
- prices
- availability

Avoid duplicate Product schema.

Before adding custom schema, check whether WooCommerce or the SEO plugin already provides it.

---

# 24. Canonicalization

Ensure correct canonical behavior for:

- products
- categories
- pagination
- search
- sorting
- filters
- query parameters

Avoid unnecessary indexable URLs such as:

```text
?orderby=
?filter=
?min_price=
?max_price=
```

Do not implement robots/canonical behavior that conflicts with the SEO plugin.

---

# 25. URL Architecture

Preferred structure:

```text
/
 /shop/
 /product/product-name/
 /product-category/category-name/
 /cart/
 /checkout/
 /my-account/
```

URLs should be:

- short
- descriptive
- stable
- readable

Do not create unnecessary IDs in URLs.

---

# 26. Breadcrumbs

Create reusable breadcrumbs.

Example:

```text
Home
 >
Shop
 >
Wall Decor
 >
Product Name
```

Visible breadcrumbs and structured data must describe the same hierarchy.

Do not duplicate breadcrumbs if an SEO plugin is already rendering them.

---

# 27. Internal Linking

Support natural internal linking through:

- primary navigation
- category links
- related products
- cross-sells
- editorial sections
- footer

Do not create keyword-stuffed internal links.

---

# 28. Image SEO

Product images must use WordPress image APIs.

Use:

- WebP
- AVIF where supported
- responsive sizes
- `srcset`
- `sizes`
- explicit dimensions
- appropriate alt text

Do not auto-generate useless alt text.

Bad:

```text
IMG_9283
image123
DSC_001
```

Good:

```text
Handcrafted ceramic vase in neutral beige
```

when that accurately describes the image.

---

# 29. Performance Strategy

Performance is a first-class feature.

Targets:

```text
LCP < 2.5s
INP < 200ms
CLS < 0.1
```

Aim for excellent real-user Core Web Vitals.

Use:

- minimal JS
- minimal CSS
- responsive images
- optimized fonts
- low DOM complexity
- lazy loading below the fold
- deferred non-critical scripts
- selective asset loading
- caching compatibility

---

# 30. CSS Strategy

Do not use a huge framework.

Prefer:

- modern CSS
- CSS variables
- flexbox
- grid
- container queries where useful
- `clamp()`
- `min()`
- `max()`
- `aspect-ratio`

Avoid:

- giant utility frameworks
- unused CSS
- deeply nested selectors
- excessive specificity
- `!important` except when genuinely necessary

---

# 31. JavaScript Strategy

Prefer vanilla JavaScript.

Avoid jQuery unless required by WooCommerce or an unavoidable dependency.

Load scripts only where required.

Examples:

- navigation JS → all pages
- product gallery JS → product pages
- cart JS → cart/mini-cart pages
- checkout-specific JS → checkout only

Do not globally load every script.

Use event delegation where practical.

Debounce search.

Avoid polling.

Avoid unnecessary DOM mutation.

---

# 32. Image Loading Strategy

Rules:

## Above the fold

Do not lazy-load the primary LCP image.

## Below the fold

Use lazy loading.

## Product cards

Use appropriate WordPress generated sizes.

## Product gallery

Use responsive high-resolution images without loading every possible size simultaneously.

Always provide intrinsic dimensions/aspect ratio.

---

# 33. Font Strategy

Use:

```text
WOFF2
```

where appropriate.

Limit font weights.

Use:

```css
font-display: swap;
```

Preload only critical fonts.

Do not load fonts from multiple providers unnecessarily.

---

# 34. Layout Stability

Prevent CLS.

Every image must have:

- width/height
- or an aspect ratio

Reserve space for:

- images
- product gallery
- banners
- fonts
- notices

Do not inject large elements above existing content after page load.

---

# 35. Asset Loading

Use WordPress enqueue APIs.

Do not hard-code:

```html
<link>
<script>
```

unless there is a specific architectural reason.

Use:

```php
wp_enqueue_style()
wp_enqueue_script()
```

Use dependency arrays correctly.

Use versioning for cache invalidation.

Load assets conditionally.

---

# 36. Accessibility

Target WCAG 2.2 AA principles.

Implement:

- keyboard navigation
- visible focus states
- semantic HTML
- accessible forms
- accessible modals
- accessible mobile navigation
- correct button/link semantics
- sufficient contrast
- reduced motion

Use ARIA only when semantic HTML cannot provide the required information.

Do not use `<div>` as a button.

---

# 37. Responsive Breakpoints

Test at minimum:

```text
320px
375px
390px
768px
1024px
1280px
1440px
1920px
```

Design mobile-first.

Do not simply shrink desktop layouts.

---

# 38. Search

Implement a clean WooCommerce product search.

Results should show:

- image
- product name
- price
- availability

If AJAX search is implemented:

- debounce input
- limit results
- return minimal data
- cache repeated requests where useful
- make it accessible

Standard server-side search must continue to work.

---

# 39. Product Filtering

Initially only a few products exist.

Do not build an elaborate filter system yet.

Architecture should remain compatible with future:

- category
- price
- color
- material
- size
- availability
- attributes

Do not introduce a heavy filtering plugin/library unless required.

---

# 40. Wishlist

Do not build a custom wishlist database system.

Keep the theme compatible with common wishlist plugins.

Provide styling hooks/classes where practical.

---

# 41. My Account

Style WooCommerce My Account.

Support:

- dashboard
- orders
- downloads
- addresses
- account details
- logout

Keep visual language consistent.

---

# 42. Thank You / Order Confirmation

Create a polished confirmation experience.

Display:

- confirmation message
- order number
- products
- totals
- payment method
- shipping details
- customer information
- next steps

Do not hide critical order information.

---

# 43. Error States

Create branded error/empty states for:

- 404
- empty cart
- no search results
- out of stock
- invalid coupon
- checkout error
- payment failure
- network failure

Do not expose raw PHP errors to users.

---

# 44. Analytics Compatibility

Do not hard-code analytics platforms.

Maintain compatibility with:

- Google Analytics
- Google Tag Manager
- Google Ads
- Meta Pixel
- WooCommerce Analytics
- Consent Management Platforms

The theme should not silently inject marketing scripts.

---

# 45. Consent / Privacy

Do not create unnecessary cookies.

Do not assume consent.

Do not load marketing scripts directly from the theme.

Allow CMP plugins to control third-party scripts.

---

# 46. Caching Compatibility

The theme must work with:

- page caching
- object caching
- CDN caching
- Cloudflare
- Redis
- WP Rocket
- LiteSpeed Cache
- hosting-level caching

Do not cache:

- cart-specific state
- checkout-specific state
- customer-specific data

Do not introduce unnecessary cache-busting.

---

# 47. Database Efficiency

Avoid unnecessary queries.

Do not query products repeatedly inside loops.

Prefer:

```php
wc_get_products()
```

or appropriate WooCommerce APIs when suitable.

Avoid repeated database calls for identical data.

Do not create custom product tables.

---

# 48. WooCommerce Hooks

Prefer hooks and filters.

Examples:

```php
add_action()
add_filter()
```

Do not remove core hooks unless there is a documented reason.

If removing a WooCommerce element, document:

- why
- what replaces it
- compatibility implications

---

# 49. Template Overrides

Only override WooCommerce templates when necessary.

For every override:

1. Confirm the native hook/filter cannot achieve the requirement.
2. Add the minimum override necessary.
3. Document the WooCommerce version relevant to the override.
4. Preserve WooCommerce hooks inside the template.
5. Avoid copying huge templates unnecessarily.

Do not blindly copy the entire WooCommerce template directory.

---

# 50. Component Architecture

Create reusable components:

```text
Button
Container
Section
ProductCard
Price
Badge
Breadcrumbs
Hero
TrustItem
Modal
Drawer
Toast
Pagination
QuantitySelector
Rating
Notice
```

Avoid duplicate markup.

Use template parts for reusable PHP components.

---

# 51. Icons

Prefer optimized SVG icons.

Required initial icons may include:

- search
- menu
- close
- cart
- account
- heart
- arrow
- chevron

Do not load a massive icon library for a handful of icons.

Ensure icons are accessible.

---

# 52. Admin / Backend

Do not replace WooCommerce Admin.

The store owner should manage everything through WooCommerce:

- products
- orders
- inventory
- customers
- coupons
- categories
- attributes
- shipping
- taxes
- payment gateways

Theme settings should be limited to genuine presentation concerns.

Do not build an unnecessary custom admin dashboard.

---

# 53. Customization

Allow sensible customization for:

- logo
- brand colors
- social links
- header
- footer
- typography where practical

Avoid creating hundreds of theme settings.

Defaults should look good without configuration.

---

# 54. Footer

Footer should contain:

- brand
- shop links
- important pages
- shipping
- returns
- privacy
- terms
- contact
- social links
- payment methods
- copyright

Use optimized SVG/image assets for payment logos.

---

# 55. Micro-interactions

Use subtle animations.

Typical duration:

```text
150–300ms
```

Animate:

- buttons
- product images
- drawers
- menus
- cart feedback
- modals

Respect:

```css
@media (prefers-reduced-motion: reduce)
```

Avoid animation that blocks interaction.

---

# 56. Conversion Optimization

Primary actions should be obvious.

Examples:

```text
Shop Now
Explore Collection
Add to Cart
Buy Now
```

On product pages, make these immediately understandable:

- product
- price
- availability
- variations
- CTA
- shipping
- returns
- payment

Avoid cluttering pages with promotional noise.

---

# 57. Trust Signals

Create reusable components for:

- secure payments
- shipping
- returns
- quality
- customer reviews

Keep them subtle and credible.

Do not invent claims.

---

# 58. Internationalization

Theme must be translation-ready.

Use a unique text domain.

Never hard-code user-facing strings.

Generate translation-ready code.

---

# 59. WordPress Coding Standards

Follow WordPress PHP coding standards.

Use meaningful names.

Avoid clever abstractions that make the code harder to understand.

Prefer straightforward code.

Comment only where comments provide useful context.

Do not write comments that merely restate the code.

---

# 60. Git / Change Discipline

Make changes in logical units.

Before each major milestone:

- inspect changed files
- review diff
- check accidental modifications
- check debug output
- check generated files

Do not overwrite unrelated work.

Do not delete files without understanding their purpose.

---

# 61. Development Verification

After each major stage run appropriate checks.

## PHP

Check:

- syntax
- warnings
- fatal errors
- undefined functions
- undefined variables

## JavaScript

Check:

- console errors
- failed network requests
- event handler failures

## CSS

Check:

- overflow
- layout shifts
- broken responsive states

## WooCommerce

Check:

- add to cart
- quantity updates
- variations
- cart totals
- checkout
- payment gateway rendering
- order creation
- order confirmation

---

# 62. Required User Flows

Test these flows end-to-end.

## Flow A — Browse

```text
Homepage
→ Shop
→ Product
```

## Flow B — Add to cart

```text
Product
→ Add to Cart
→ Cart
```

## Flow C — Purchase

```text
Product
→ Cart
→ Checkout
→ Payment
→ Order Confirmation
```

## Flow D — Account

```text
Login
→ My Account
→ Orders
→ Order Details
```

## Flow E — Search

```text
Search
→ Results
→ Product
```

---

# 63. PageSpeed Testing

Test at minimum:

- homepage
- shop
- product
- cart
- checkout

Test:

- mobile
- desktop

Review:

- LCP
- INP
- CLS
- render-blocking resources
- unused CSS
- unused JS
- image sizing
- font loading
- third-party scripts
- total request count
- DOM size

Fix the underlying issue.

Do not blindly add optimization plugins or hacks.

---

# 64. SEO Validation

Validate:

- title
- H1
- heading hierarchy
- canonical
- robots
- sitemap compatibility
- product schema
- breadcrumb schema
- organization schema
- Open Graph
- internal links
- image alt
- indexability
- pagination
- product categories
- search behavior
- filters

Do not create duplicate schema.

---

# 65. Accessibility Validation

Test:

- keyboard navigation
- focus visibility
- mobile menu
- cart drawer
- product gallery
- quantity selector
- forms
- checkout
- error messages

Check for:

- missing labels
- invalid button semantics
- poor contrast
- inaccessible modals
- inaccessible dropdowns

---

# 66. Browser Testing

Test current versions of:

- Chrome
- Edge
- Firefox
- Safari

Also test:

- mobile Safari
- mobile Chrome

---

# 67. Common Mistakes — DO NOT Make These

## Mistake 1 — Building a page-builder theme

Do not use Elementor/Divi/etc.

## Mistake 2 — Putting everything in functions.php

Keep it modular.

## Mistake 3 — Loading all assets everywhere

Conditionally load scripts and styles.

## Mistake 4 — Loading giant libraries

If vanilla JS solves it, use vanilla JS.

## Mistake 5 — Lazy-loading the LCP image

Do not lazy-load the critical above-the-fold image.

## Mistake 6 — Loading 10MB product images

Use WordPress image sizes and modern formats.

## Mistake 7 — Hard-coding product information

Products belong to WooCommerce.

## Mistake 8 — Rebuilding WooCommerce

Use WooCommerce.

## Mistake 9 — Modifying WooCommerce core

Never.

## Mistake 10 — Building payment processing in the theme

Never.

## Mistake 11 — Treating a QR image as payment verification

A QR code is not proof of payment.

## Mistake 12 — Duplicating SEO plugin functionality

Avoid duplicate:

- canonical tags
- meta descriptions
- schema
- Open Graph

## Mistake 13 — Making important content JS-only

Search engines and users without JS should still receive meaningful HTML.

## Mistake 14 — Excessive animations

Decor ecommerce needs elegance, not a theme park.

## Mistake 15 — Overengineering filters for five products

Don't.

## Mistake 16 — Using `!important` everywhere

Fix specificity instead.

## Mistake 17 — Using `<div>` as buttons

Use semantic HTML.

## Mistake 18 — Ignoring mobile

Mobile is a first-class storefront.

## Mistake 19 — Adding dependencies without justification

Every dependency must earn its place.

## Mistake 20 — Declaring success because the homepage looks good

The theme is not complete until WooCommerce flows, SEO, accessibility, security, and performance have been tested.

---

# 68. Recommended Implementation Order

Follow this order unless repository constraints require otherwise.

### Step 1

Repository audit.

### Step 2

Theme skeleton.

### Step 3

Theme setup and WordPress integration.

### Step 4

Design tokens.

### Step 5

Global typography and CSS foundation.

### Step 6

Header/navigation.

### Step 7

Footer.

### Step 8

Homepage.

### Step 9

WooCommerce product cards.

### Step 10

Shop/archive.

### Step 11

Single product.

### Step 12

Cart.

### Step 13

Checkout.

### Step 14

My Account.

### Step 15

404/search/empty states.

### Step 16

SEO integration.

### Step 17

Performance optimization.

### Step 18

Accessibility.

### Step 19

Security review.

### Step 20

End-to-end ecommerce testing.

### Step 21

PageSpeed/Core Web Vitals testing.

### Step 22

Final code cleanup.

---

# 69. Final Quality Gate

Do not declare the project complete until all of the following are true.

## Design

- [ ] Premium visual design
- [ ] Consistent design system
- [ ] Mobile-first
- [ ] Responsive
- [ ] No obvious layout bugs
- [ ] No excessive visual effects

## WooCommerce

- [ ] Product pages work
- [ ] Product archives work
- [ ] Add to cart works
- [ ] Cart works
- [ ] Checkout works
- [ ] Coupons work
- [ ] Inventory works
- [ ] Variations work
- [ ] Customer accounts work
- [ ] Orders work
- [ ] Reviews work

## Payments

- [ ] WooCommerce-compatible gateway works
- [ ] UPI supported
- [ ] Payment status comes from trusted gateway/server-side verification
- [ ] QR option, if enabled, does not falsely mark orders paid
- [ ] No payment secrets are stored in theme code

## SEO

- [ ] Semantic HTML
- [ ] Correct heading structure
- [ ] Product content server-rendered
- [ ] Canonical compatibility
- [ ] Sitemap compatibility
- [ ] Schema compatibility
- [ ] Breadcrumbs
- [ ] Open Graph compatibility
- [ ] Internal linking
- [ ] Image alt text
- [ ] Search/filter indexation handled correctly

## Performance

- [ ] Minimal JS
- [ ] Minimal CSS
- [ ] Conditional assets
- [ ] Optimized images
- [ ] Responsive images
- [ ] Optimized fonts
- [ ] No unnecessary third-party scripts
- [ ] No major CLS issues
- [ ] Strong LCP
- [ ] Strong INP
- [ ] Strong real-world Core Web Vitals

## Accessibility

- [ ] Keyboard navigation
- [ ] Focus states
- [ ] Form labels
- [ ] Accessible menus
- [ ] Accessible modals/drawers
- [ ] Reduced motion
- [ ] Semantic controls
- [ ] Good contrast

## Security

- [ ] Inputs sanitized
- [ ] Outputs escaped
- [ ] Nonces implemented where needed
- [ ] No secrets in theme
- [ ] No core modifications
- [ ] No WooCommerce core modifications
- [ ] Production debug output disabled

## Maintainability

- [ ] Modular PHP
- [ ] Modular CSS
- [ ] Modular JS
- [ ] Reusable components
- [ ] Minimal WooCommerce overrides
- [ ] Translation-ready
- [ ] Documentation available

---

# 70. Final Engineering Principle

Build this theme as if it will eventually become a serious ecommerce platform.

But do not build unnecessary complexity today.

The correct philosophy is:

```text
Simple now
        ↓
Structured underneath
        ↓
Fast at launch
        ↓
Scales without a rewrite
```

The finished website should feel:

```text
Premium
+ Modern
+ Warm
+ Editorial
+ Fast
+ Accessible
+ SEO-first
+ Conversion-focused
```

It should never feel like:

```text
Generic WordPress
+ Generic WooCommerce
+ Marketplace Theme
```

The goal is not merely to make WooCommerce work.

The goal is to create a **high-performance, search-friendly, premium ecommerce storefront with a clean engineering foundation that can grow with the business.**
