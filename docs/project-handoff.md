# Sierra Madre FSE project handoff

Updated: 5 September 2026

## Latest continuation

- Live single-post comparison completed at 390, 768, 1440, and 1920px on `/long-road-north/` and `/field-journal-01/` against `HTML/single.html`.
- Corrected Gutenberg adapters for paragraph/heading spacing, full-width image sizing, diptych columns/crops/captions, footer typography, mobile intro spacing, and next-story navigation. Both story-pattern prose sections and image geometry match the prototype at all four widths; neither live route has horizontal overflow.
- Ordinary content retains the 660px maximum prose measure and story typography preset; H3–H6 now have a readable size hierarchy.
- Long titles use smaller natural wrapping. Real WordPress renderer checks covered short, long, Unicode, dollar-sign, and HTML-containing titles.
- Corrected editor stylesheet order, scrolled-header contrast, and overlay focus timing. Live checks passed for search input focus, Escape/focus restoration, menu open/close, and the next-story link.
- PHP syntax, JSON parsing, JavaScript syntax, and whitespace checks passed. Full editor/admin-bar and missing-content QA remain open.
- Structured intro metadata and photography-credit modeling remain pending; the current taxonomy mapping is still temporary.

## Page-template checkpoint

- `templates/page.html` now provides a dynamic title, optional featured image, and native Post Content with a 660px prose measure. Existing page content is preserved.
- `templates/editorial-page.html` is an optional content-only template registered in `theme.json`. Pair it with the Complete editorial page pattern, which supplies the visible H1.
- Five reusable page-section patterns and one assembled starter pattern cover the complete `HTML/page.html` composition. Setup is documented in `readme.txt`.
- Local review draft: **About Sierra Madre**, ID **1868**, slug `sierra-madre-editorial-preview`, assigned to **Editorial page**. Edit at `http://localhost:10058/wp-admin/post.php?post=1868&action=edit`. It is not published, and the existing About test page was not replaced.
- WordPress's browser block parser validated all 37 blocks in the assembled pattern and its save serialization with no invalid blocks.
- The complete editorial preview and the existing Sample Page were compared at 390, 768, 1440, and 1920px without horizontal overflow. The editorial preview used WordPress-rendered content without publishing the draft. All six main editorial section heights match the prototype within subpixel rounding at the four widths. Homepage smoke checks at 390 and 1440px also showed no horizontal overflow.
- The contact email is still `field@sierramadre.example`; set the real address and contributor destination before publishing. Replace starter photography via the Media Library.
- Theme Check was run and currently fails release packaging: missing screenshot and Author/License/License URI/Tested up to stylesheet headers. It also reports a missing copyright notice and eight large-image warnings across the prototype and theme asset copies. These remain release tasks.

## Current baseline

- The FSE foundation, global design tokens, fonts, header, footer, menu overlay, and search overlay are implemented.
- `HTML/index.html` is wired to `templates/front-page.html` through `patterns/home-hero.php` and `patterns/home-body.php`.
- Homepage editorial sections use standard posts, categories, featured images, excerpts, and permalinks. The Field Notes feed is automatic; the prominent homepage features are curated.
- `HTML/single.html` is wired to `templates/single.html` with a dynamic featured-image hero, post title, author, tags, date, reading time, excerpt, terms, content, and next-post navigation.
- Three reusable story-editor layouts are available: article section with field note, full-width image, and image diptych. A continuation variation is also registered.
- The original prototype stylesheet is preserved as `assets/css/theme.css`. New work should continue to use `theme.json` first and add only Gutenberg markup adapters or unsupported selectors to `style.css`.

## Completed prototype coverage

| Prototype | FSE target | Status |
|---|---|---|
| `HTML/index.html` | `templates/front-page.html` | Wired; continue regression QA when shared styles change |
| `HTML/single.html` | `templates/single.html` | Wired; fidelity refinement remains |
| `HTML/page.html` | `templates/page.html` + optional `templates/editorial-page.html` | Wired with reusable native editorial patterns |
| Global header | `parts/header.html` | Wired and dynamic |
| Global footer | `parts/footer.html` | Wired and dynamic |

## Single-template work still needed

1. Repeat regression comparisons when shared styles change. The initial full-page desktop/mobile pass is complete.
2. Continue ordinary-content QA beyond the Heading/Paragraph case, including tables, embeds, nested groups, and alignment variations.
3. Typography and the ordinary-content 660px measure are verified at 390, 768, 1440, and 1920px. Story patterns retain the prototype’s narrower grid column.
4. Replace the intro's temporary category/tag summary with editable structured presentation equivalent to Location, Coordinates, and Conditions. Persistent custom metadata must live in a companion plugin; theme-only starter values can remain editable pattern content.
5. Continue title stress testing with unusually lengthy translated content. Short titles retain their markup; titles over 40 characters use smaller natural wrapping.
6. Decide how photography credits should be modeled. The current prototype mapping uses post tags for the credit line.
7. Test posts with no author, featured image, excerpt, categories, tags, or adjacent post and provide graceful fallbacks.
8. Move story-pattern images from theme-asset URLs to Media Library selections before production content is entered, so post content does not depend on the active theme directory.

## Unwired templates

Implement these in this order:

1. `HTML/archive.html` → `templates/archive.html`
   - Dynamic archive title and description
   - Category navigation
   - Inherited Query Loop/Post Template
   - Pagination and empty state
2. `HTML/search.html` → `templates/search.html`
   - Dynamic search title and form
   - Inherited results Query Loop
   - Pagination and no-results state
3. `HTML/404.html` → `templates/404.html`
   - Prototype error composition
   - Working home/search actions

The conceptual reusable-pattern inventory remains in `docs/pattern-audit.md`. Archive cards and search-result rows belong inside Query Loop Post Templates, not separately registered patterns.

## Dynamic-content follow-up

- Confirm that every curated homepage section can be changed safely in the Site Editor without editing PHP.
- Revisit `patterns/home-body.php`: curated queries currently resolve posts during pattern registration. Prefer saved Query blocks or another editor-controlled native approach where possible.
- Confirm the Places hover-preview script uses each rendered post's featured-image URL and behaves correctly with keyboard focus and touch input.
- Verify menu assignments, empty navigation behavior, next-post behavior, archive filters, and search submission.
- Keep required category slugs and editorial setup instructions synchronized with `readme.txt`.

## QA and release checklist

- Compare each FSE route against its matching `HTML/` file at desktop and mobile sizes.
- Test keyboard navigation, visible focus, skip link, menu/search overlay focus handling, reduced motion, and image alternative text.
- Test the Site Editor and post editor, not only the front end.
- Test with the admin bar both present and absent.
- Run PHP syntax checks, `jq empty theme.json`, `git diff --check`, and WordPress Theme Check.
- Validate responsive images, missing-content states, long titles, translated strings, and pagination.
- Consolidate image/font licensing details in `readme.txt` before submission.
- Audit all bundled PHP and theme behavior against the current WordPress.org Theme Review requirements before release.

## Local development notes

- Site: `http://localhost:10058/`
- Current ordinary-content single-post test: `http://localhost:10058/field-journal-01/`
- Pattern-composed single-post test: `http://localhost:10058/long-road-north/`
- Static single reference: `HTML/single.html`
- Local demo content was added for development only. Theme activation must not create posts, terms, users, attachments, or other starter content.

## Recommended next session

Review the unpublished editorial page (ID 1868), then implement `HTML/archive.html` as a native inherited Query Loop in `templates/archive.html`. Single-post visual/layout refinements are checkpointed in `03aaa98`. Keep structured story metadata, photography-credit modeling, full editor/admin-bar QA, and Theme Check release findings on the follow-up list.
