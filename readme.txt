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

The homepage combines automatic feeds with deliberately selected editorial features. Posts remain ordinary WordPress posts so content is retained when the theme is changed.

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

Do not change these slugs without also updating the corresponding homepage Query blocks. Category names may be translated or changed for display, but their slugs form the default query contract.

= Curated homepage sections =

The following prominent sections are curated. An editor deliberately chooses or configures the post displayed in each Query Loop:

* Homepage hero
* Featured journey
* Featured place
* Photo essay
* People / conversation feature
* Transit feature
* Culture / table story
* Current issue promotion

For every curated post, provide a title, excerpt, featured image, category, and published permalink. Where a Query Loop offers category or sticky-post filters, configure the block in Appearance > Editor rather than duplicating the post content in the template.

= Automatic homepage sections =

The Field Notes section displays recent posts from the field-notes category and should update automatically as posts are published.

The Places Index is intended to display Place entries and use their featured images as interactive previews. Each Place entry needs a title, featured image, and any displayed geographic information.

= Related metadata =

The Field Log belongs to the currently featured journey. Until a companion plugin supplies structured geographic metadata, its values remain editable pattern content. The theme must not register permanent business-critical metadata or content types.

= Static sections =

Opening Notes and the Newsletter presentation are normal editable pattern content. Newsletter delivery and subscriber storage require a plugin or external service selected by the site owner.

= Missing-content behavior =

Homepage queries should fail gracefully when no matching post exists. Installing or activating the theme must not create categories, posts, attachments, or other starter content automatically.

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

== Frequently Asked Questions ==

= Does the theme register custom post types? =

No. Persistent content models belong in a plugin. The default homepage uses standard posts, categories, featured images, excerpts, and Query Loops.

= Does activating the theme install demo content? =

No. Demo content used during theme development is not imported automatically and is not required for activation.

== Changelog ==

= 0.1.0 =

* Added the initial block-theme foundation, global header and footer, homepage patterns, and editorial curation documentation.

== Resources ==

Bundled asset licensing and sources are documented in assets/images/CREDITS.txt and assets/fonts/LICENSE.txt. These records will be consolidated before a WordPress.org release.
