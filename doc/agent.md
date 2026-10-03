# Agent Guide — Mirayas Decor

How an AI (or human) contributor should work on this theme. These rules keep
changes consistent with the architecture already in place. When this guide and
the code disagree, follow the code — then update this guide.

## 1. Understand the architecture before changing it

- `functions.php` is only a bootstrap. Real logic lives in `inc/*.php` modules,
  loaded in a fixed order via the filterable `mirayas_modules` list:
  `setup`, `enqueue`, `performance`, `security`, `seo`, `template-functions`,
  `template-hooks`, `woocommerce`, `customizer`.
- Find the right home for a change before writing one:
  - Feature / setting        → `inc/customizer.php`
  - Asset / dependency       → `inc/enqueue.php`
  - Output helper            → `inc/template-functions.php`
  - Front-page section wiring → `inc/template-hooks.php`
  - Markup                   → `template-parts/**` (never inline big chunks
    into root templates)
- Every function, hook, filter and text-domain string is prefixed `mirayas` /
  `mirayas_`. Keep it that way.

## 2. WordPress best practices (non-negotiable)

- **Hooks over edits.** Templates render through `do_action( 'mirayas_front_*' )`.
  Add, remove or reorder sections via hooks — never by hacking `front-page.php`.
- **Escape everything on output** (`esc_html`, `esc_url`, `wp_kses_post`, …)
  and **sanitize every setting input** (see the per-field sanitize callbacks
  in `inc/customizer.php`).
- **Never hardcode copy in templates.** Default copy comes from
  `mirayas_default()` / `get_theme_mod()` so the Customizer can change it.
- **Translation-ready.** All strings wrapped in `__()` / `esc_html__()` with
  the `mirayas-decor` text domain. New user-facing strings ⇒ update
  `languages/mirayas-decor.pot`.
- **No page builders, no frameworks.** Vanilla JS and native WP/Woo hooks
  only. jQuery is allowed solely where WooCommerce requires it (`cart.js`
  listens to jQuery's `added_to_cart` event).
- **Child-theme safe.** The `mirayas_modules` filter and
  `mirayas_front_section_enabled` filter must keep working; never remove a
  hook another theme or plugin may be riding on.
- **Performance bar.** Scripts are deferred via the WP 6.3+ `strategy`
  argument and load conditionally (`product.js` only on product pages,
  Woo assets only when the plugin is active). Above-the-fold fonts are
  preloaded in `wp_head`. Preserve all of this.

## 3. CSS discipline

The cascade order is the theme's specificity mechanism. `inc/enqueue.php`
loads styles as one dependency chain:

    fonts → tokens → base → layout → components → utilities → woocommerce

- Put new rules in the layer file matching their concern
  (page scaffolding → `layout.css`, components → `components.css`,
  shop pages → `woocommerce.css`).
- Use the design tokens from `tokens.css` (`--space-*`, `--color-*`,
  `--text-*`, `--radius-*`). Do not invent magic values.
- Override by **adding specificity, never `!important`**. Worked example from
  1.0.1: the global `.site-footer` top margin is right for inner pages, so
  the front page scopes it off with `.home .site-footer { margin-block-start: 0; }`
  using the `home` body class WordPress prints on the front page.
- **No long-term CSS in Appearance → Additional CSS.** If a fix is real enough
  to keep, migrate it into the theme files and delete it from the Customizer
  on the next deploy (see the 1.0.1 entry in `changelog.md` for the procedure).

## 4. Versioning & cache busting

Any change under `assets/**` requires bumping the version **in both places**:

- `MIRAYAS_VERSION` in `functions.php` (drives asset query strings), and
- `Version:` in the `style.css` header (drives WP admin display).

They must stay in sync. Update `doc/changelog.md` in the same commit.

## 5. Verification bar (a change is not done until…)

- Read the final file back — confirm complete braces, no truncation, no stray
  edits.
- Check the change **in context**, not in isolation: a page-scoped fix
  (e.g. `.home …`) must not leak into other templates; a global rule change
  must be reviewed on front page, shop and post pages.
- Prefer live DOM / computed-style checks in the browser over assumptions.
- `git diff` must show exactly the intended change — nothing else riding along.

## 6. Git & documentation workflow

- Small, single-concern commits with descriptive messages.
- Every change updates `doc/changelog.md` (what changed, when, commit hash).
- Architecture-level drift updates `doc/currentstate.md`.

## 7. Environment quirks (this machine)

- Shell output capture is flaky (`exit 130`). Commands still execute —
  redirect output to a file and read it back, e.g.
  `git --no-pager diff > /tmp/out.txt` then read `/tmp/out.txt`.
- Trust direct file reads over terminal scrollback for verification.