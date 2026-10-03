# Current State — Mirayas Decor

Snapshot taken **2026-10-03**, updated after the v1.0.1 release commit.
See `changelog.md` for what changed and `agent.md` for how to work here.

## Identity

- **Theme:** Mirayas Decor — premium WooCommerce theme for home-decor stores.
- **Type:** classic (PHP) theme. No page builders, no frameworks, vanilla JS.
- **Targets:** WordPress 6.4+ (tested 6.7), PHP 7.4+. WooCommerce optional —
  the theme no-ops without it. Accessibility: WCAG 2.2 AA. SEO-first.
- **Site:** https://mirayasdecor.in · text domain `mirayas-decor` · GPL-2.0+.
- **Version:** **1.0.1** — bumped in `style.css` + `MIRAYAS_VERSION`.

## Repository

- Remote: `github.com:ranababu1/mirayasdecor` (local clone created 2026-10-03).
- v1.0.1 released on `main` as `8e4eb28` — 5 files, +26/−3: desktop nav
  alignment fix, front-page footer-gap fix, two Additional-CSS migrations,
  version bump. This doc folder followed in its own commit.
- Deployment flow: work lands on `main`, then merges to `prod` via PR
  (see repo history: PRs #2/#3/#4).

## Architecture

### Bootstrap & modules (`functions.php` → `inc/`)

Defines `MIRAYAS_VERSION` / `MIRAYAS_DIR` / `MIRAYAS_URI` and
`mirayas_has_woocommerce()`, then loads a filterable module list
(`mirayas_modules`): `setup` · `enqueue` · `performance` · `security` ·
`seo` · `template-functions` · `template-hooks` · `woocommerce` ·
`customizer`.

### Templates

- **Root:** `index`, `front-page`, `home`, `page`, `single`, `archive`,
  `search`, `404`, `comments`, `searchform`, `header`, `footer`.
- **`template-parts/`:** `components/` (empty-state, page-header,
  payment-icons, post-card) · `content/` (none, page, single, content) ·
  `header/` (actions, announcement-bar, branding, cart-drawer, nav-drawer,
  navigation, search-dialog) · `footer/` (widgets) · `home/` (hero, featured,
  collections, story, editorial, trust, newsletter).
- **`woocommerce/`:** `archive-product`, `single-product`, `cart/cart-empty`,
  `cart/mini-cart`, `checkout/thankyou`, `myaccount/dashboard`.

### Front page flow

`front-page.php` fires `do_action()` hooks wired in `inc/template-hooks.php`;
each section checks its Customizer toggle (`mirayas_show_<section>`,
filterable via `mirayas_front_section_enabled`).

**Currently rendered:** hero → featured → trust → newsletter.
`collections`, `story` and `editorial` are fully wired and have Customizer
toggles but are **not fired** by `front-page.php` right now — re-enabling one
is a single `do_action()` line. The full-bleed newsletter panel is the last
section, which is why the 1.0.1 fix lets the footer sit flush on the front
page only.

### Assets

- **CSS** — one dependency chain, cache-busted by `MIRAYAS_VERSION`:
  `fonts → tokens → base → layout → components → utilities → woocommerce`
  (the last only when WooCommerce is active). Design tokens live in
  `tokens.css` and are mirrored into the block editor (palette: Ink
  `#1d1d1b`, Forest `#303a32`, Clay `#9a7b5a`, Sand `#f4f1eb`, Ivory
  `#faf9f6`).
- **JS** — `main.js`, `navigation.js` (deferred, dependency-free);
  `cart.js` (jQuery, WooCommerce `added_to_cart`); `product.js`
  (product pages only).
- **Fonts** — Inter var + Fraunces var (`woff2`, preloaded); italic Fraunces
  loads lazily.

### Features

- Menus: `primary`, `footer`. Widget areas: `footer-1…3`.
- Image sizes: `mirayas-card` 640×800, `mirayas-wide` 1200×900.
- Content width 1240px (filterable via `mirayas_content_width`).
- WooCommerce support declared unconditionally (grid 3 cols / 2–4, catalog
  thumb 480px, single 1000px) so the shop works the moment the plugin
  activates.

### Customizer panel "Mirayas Decor"

- **Header:** announcement bar (show toggle + text, live partial).
- **Front Page:** per-section toggles (hero, featured, collections, story,
  editorial, trust, newsletter) plus copy fields with selective refresh
  (hero title/text, newsletter title/text, trust items, …). Defaults come
  from `mirayas_default()` — templates never hardcode copy.
- **Footer:** copyright line with `{year}` / `{site}` placeholders.

## Pending work

1. **Deploy:** remove the two migrated rules from
   *Appearance → Customize → Additional CSS* when 1.0.1 goes live.
2. **Post-deploy verification** (hard refresh, Cmd+Shift+R):
   - Front page: newsletter band sits flush against the dark footer.
   - Inner pages (shop, posts): footer keeps its 4rem top breathing room.
   - Desktop nav: all top-level items vertically centred on one line.
   - Breadcrumbs hidden on screen; BreadcrumbList schema still in the source.
   - Shop toolbar: the ordering dropdown keeps its 30px vertical margin.
3. If a check fails on the live site, inspect the real DOM before touching
   CSS again.

## Environment notes

- Dev shell output capture is broken (`exit 130`); commands still execute —
  redirect output to `/tmp/*.txt` and read it back. Direct file reads are
  reliable.
- Root `README.md` exists but is empty (placeholder).