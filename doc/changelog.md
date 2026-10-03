# Changelog — Mirayas Decor

All notable changes to this theme. Format loosely follows
[Keep a Changelog](https://keepachangelog.com/); each entry records **what**
changed, **when** it changed, and the **commit** that shipped it.

## [1.0.1] — 2026-10-03 — commit `8e4eb28`

Released on top of `b58c34d` — 5 files, +26 / −3, shipped to `prod` via
the main → prod PR.

### Fixed

- **Desktop nav items sat progressively lower than the first.** `base.css`
  stacks plain lists via `li + li { margin-block-start }`; inside the flex nav
  row that margin is centred rather than collapsed, dropping every following
  item by half the margin. Neutralised for top-level items only:
  `.site-navigation__list > li + li { margin-block-start: 0; }`
  (`assets/css/components.css` ~114–122). Drop-down items keep their rhythm.
- **4rem gap between the front-page newsletter band and the footer.** The
  global `.site-footer { margin-block-start: var(--space-3xl) }` is right for
  inner pages but wrong beneath the full-bleed newsletter panel. Scoped off on
  the front page only: `.home .site-footer { margin-block-start: 0; }`
  (`assets/css/layout.css` ~132–135). All other pages keep the breathing room.

### Migrated — Customizer "Additional CSS" → theme files

- `.breadcrumbs { display: none; }` → `assets/css/components.css` (~896).
  Breadcrumb *schema* is unaffected: `mirayas_breadcrumbs()` emits the
  BreadcrumbList JSON-LD server-side (`inc/template-functions.php`).
- `.woocommerce .woocommerce-ordering,
  .woocommerce-page .woocommerce-ordering { margin: 30px 0; }` → folded into
  the existing rule in `assets/css/woocommerce.css` (~441).

> **Deploy step:** delete both rules from
> *Appearance → Customize → Additional CSS* when this version ships, so the
> theme files are the single source of truth.

### Changed

- Version 1.0.0 → **1.0.1** in the `style.css` header and `MIRAYAS_VERSION`
  (`functions.php`) — cache-busts every CSS/JS asset on deploy.

### Files touched

| File | Change |
|---|---|
| `assets/css/components.css` | +18 (nav fix + breadcrumbs migration) |
| `assets/css/layout.css` | +5 (front-page footer fix) |
| `assets/css/woocommerce.css` | ±1 (catalog-ordering margin migration) |
| `functions.php` | ±1 (version bump) |
| `style.css` | ±1 (version bump) |

---

## [1.0.0] — 2026-09-21 — commit `9bc8f89`

Initial complete release: "Add Mirayas Decor v1.0.0 - complete classic
WooCommerce theme" — hook-driven front page, token-based CSS cascade, vanilla
JS, WooCommerce integration, plus the SEO / security / performance modules.
Preceded by `b768ca0` "First Push" (2026-09-21).

### History after 1.0.0 (already on `main`)

| Date | Commit | Message |
|---|---|---|
| 2026-09-22 | `9e6df9e` | style fix. |
| 2026-09-22 | `332419c` | Merge pull request #2 from ranababu1/main |
| 2026-09-22 | `faede19` | Merge pull request #3 from ranababu1/prod |
| 2026-09-23 | `f66f255` | Structure updates |
| 2026-09-23 | `b58c34d` | Merge branch 'main' of github.com:ranababu1/mirayasdecor *(HEAD when the 1.0.1 work started)* |