=== Sierra Madre ===
Contributors: rollybueno
Requires at least: 7.1
Tested up to: 7.1
Requires PHP: 8.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An editorial block theme for field journals, long-form stories, photography, people, and places.

== Description ==

Sierra Madre is a Full Site Editing theme built with native WordPress blocks, block patterns, template parts, and theme.json.

== Homepage content and curation ==

The homepage (v2) is composed of seven patterns in `templates/front-page.html`: hero, opening, journal, places, photography, dispatches, and postscript. Tokens and base typography live in theme.json; complex layout stays in `assets/css/theme.css`.

= Required categories =

Create or retain the following categories and slugs:

* Journeys: journeys
* Homepage Hero: homepage-hero
* Field Notes: field-notes
* Places: places
* Photography: photography
* People: people
* Movement: movement
* Culture: culture
* Issues: issues

Do not change these slugs without also updating the homepage patterns in `patterns/home-*.php`. Category names may be translated or changed for display, but their slugs form the default query contract.

= Curated homepage sections =

Each section picks the latest published post in its category (with static prototype fallbacks when empty):

* Homepage hero — `homepage-hero`
* Journal lead — `journeys`
* Places feature and cards — `places` (up to five)
* Photo essay — `photography` (attached images preferred for the sequence)
* Dispatches cards — `people`, `culture`, `movement`
* Current issue — `issues`

For every curated post, provide a title, excerpt, featured image, category, and published permalink.

= Automatic homepage sections =

Recent notes inside the journal band display the two latest `field-notes` posts.

= Static sections =

The opening band and field-letters form are pattern content. Newsletter delivery requires a plugin or external service selected by the site owner.

= Missing-content behavior =

Homepage picks fail gracefully when no matching post exists. Installing or activating the theme must not create categories, posts, attachments, or other starter content automatically.

== Installation ==

1. Upload the theme to the wp-content/themes directory.
2. Activate Sierra Madre in Appearance > Themes.
3. Open Appearance > Editor to configure navigation and homepage queries.
4. Assign posts to the documented categories and add featured images.

== Pages and editorial layouts ==

The default Page template displays the page title, optional featured image, and editable page content. Existing pages keep their content and use this template automatically unless another template is assigned.

To build a page matching the editorial prototype:

1. Create or edit a page and select the Editorial page template in the page settings.
2. Insert the Complete editorial page pattern from the Sierra Madre category. This includes the page's visible H1, so the Editorial page template does not add another title.
3. Edit the introduction, panoramic image, manifesto, numbered principles, contributors, and contact sections directly in the page editor. Each section is also available as a separate pattern.
4. Replace the sample contact email and contributor link with your real destinations. The starter contributor link searches the site; the work-with-us link leads to the contact section.
5. Replace the starter photographs using the Image block's Media Library control before publishing production content. The bundled starter URLs are tied to the theme directory.

These are unsynced patterns: editing one page does not change another page. Activating the theme does not create pages or assign templates to existing content.

== Single stories ==

The single post template includes a full-bleed story hero, excerpt as deck, field metadata, post content, and a story footer with taxonomy and next-post navigation.

Optional post meta (Custom Fields) for the intro metadata strip:

* `sm_location` — place name (default: Cordillera, Luzon)
* `sm_coordinates` — lat/long text; use a line break between values (default: 17.0832° N / 120.8995° E)
* `sm_conditions` — weather or field conditions (default: Rain / 18°C)

Longer story layouts (aside + prose, full-bleed image, diptych) are available as Sierra Madre patterns for editors to insert into post content.

Primary and footer Journal links use root-relative homepage anchors (`/#journeys`, `/#places`, and so on) so they work from single posts and other templates. Information links target `/about/` and the posts archive; create an About page at that path when you need those destinations live.

== Archives, search, and 404 ==

Category, tag, and posts-index views use the archive composition: large archive hero, category filter links (All / Field Notes / Photography / People / Culture when those categories exist), an asymmetric Query Loop grid, and pagination.

Search uses a listing hero with the current query, an inline search field, and a dense result list. The 404 template is a full-bleed error stage with a return link to the front page.

== Frequently Asked Questions ==

= Does the theme register custom post types? =

No. Persistent content models belong in a plugin. The default homepage uses standard posts, categories, featured images, and excerpts.

= Does activating the theme install demo content? =

No. Demo content used during theme development is not imported automatically and is not required for activation.

== Changelog ==

= 0.2.4 =

* Make header Search/Menu inherit header color on the hero, and keep overlay Close buttons visible on dark panels.

= 0.2.3 =

* Keep the front-page header absolute over the hero when the site uses latest posts (`home blog`).
* Add a comments template part to page and single templates when discussion is open.

= 0.2.2 =

* Wired archive, home/index, search, and 404 templates to the editorial prototypes.
* Restored story byline (words / photographs / date) and enriched the default page hero.

= 0.2.1 =

* Root-relative menu and footer Journal anchors so section links work off the front page.
* Restored story intro field metadata (Location / Coordinates / Conditions) via optional post meta.

= 0.2.0 =

* Rebuilt the front page around the v2 editorial prototype.
* Split homepage into section patterns; theme.json-first tokens with theme.css layout fallbacks.
* Removed the v1 home-body mega-pattern and field-notes Query Loop filter.

= 0.1.0 =

* Added the initial block-theme foundation, global header and footer, homepage patterns, and editorial curation documentation.

== Resources ==

Bundled asset licensing and sources are documented in assets/images/CREDITS.txt and assets/fonts/LICENSE.txt. These records will be consolidated before a WordPress.org release.
