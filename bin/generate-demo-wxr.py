#!/usr/bin/env python3
"""Generate demo-content/sierra-madre-curated.xml (WXR) for homepage curation."""

from __future__ import annotations

from datetime import datetime, timedelta, timezone
from pathlib import Path
from xml.sax.saxutils import escape

ROOT = Path(__file__).resolve().parents[1]
OUT = ROOT / "demo-content" / "sierra-madre-curated.xml"
SITE = "http://wp-theme-sierra-madre.local"


def detect_media_base() -> str:
	"""
	WordPress downloads attachment_url over HTTP. PHP on Local cannot resolve
	*.local hostnames, but 127.0.0.1:{nginx_port} works.
	"""
	sites_json = Path.home() / ".config/Local/sites.json"
	port = None
	if sites_json.is_file():
		import json

		sites = json.loads(sites_json.read_text())
		for site in sites.values():
			blob = str(site.get("path", "")) + str(site.get("domain", "")) + str(site.get("name", ""))
			if "sierra-madre" in blob.lower() or "wp-theme-sierra" in blob.lower():
				ports = site.get("services", {}).get("nginx", {}).get("ports", {})
				http_ports = ports.get("HTTP") or ports.get("http") or []
				if http_ports:
					port = http_ports[0]
					break
	if not port:
		port = 10058
	return f"http://127.0.0.1:{port}/wp-content/themes/sierra-madre/assets/images"


THEME_IMG = detect_media_base()
BASE = datetime(2026, 8, 28, 10, 0, 0, tzinfo=timezone.utc)


def rfc2822(dt: datetime) -> str:
	return dt.strftime("%a, %d %b %Y %H:%M:%S +0000")


def mysql_dt(dt: datetime) -> str:
	return dt.strftime("%Y-%m-%d %H:%M:%S")


def cdata(text: str) -> str:
	return f"<![CDATA[{text}]]>"


def prose(*paras: str) -> str:
	blocks: list[str] = []
	for i, paragraph in enumerate(paras):
		if i == 0:
			blocks.append(
				'<!-- wp:paragraph {"dropCap":true} -->\n'
				f'<p class="has-drop-cap">{paragraph}</p>\n'
				"<!-- /wp:paragraph -->"
			)
		else:
			blocks.append(
				"<!-- wp:paragraph -->\n"
				f"<p>{paragraph}</p>\n"
				"<!-- /wp:paragraph -->"
			)
	return "\n\n".join(blocks)


CATEGORIES = [
	(1, "Journeys", "journeys"),
	(2, "Homepage Hero", "homepage-hero"),
	(3, "Field Notes", "field-notes"),
	(4, "Places", "places"),
	(5, "Photography", "photography"),
	(6, "People", "people"),
	(7, "Movement", "movement"),
	(8, "Culture", "culture"),
	(9, "Issues", "issues"),
]

IMAGES = {
	"hero-01.jpg": 201,
	"journey-01.jpg": 202,
	"fieldnote-01.jpg": 203,
	"coast-01.jpg": 204,
	"place-01.jpg": 205,
	"fieldnote-02.jpg": 206,
	"photoessay-01.jpg": 207,
	"photoessay-02.jpg": 208,
	"photoessay-03.jpg": 209,
	"portrait-01.jpg": 210,
	"food-01.jpg": 211,
	"transit-01.jpg": 212,
	"issue-01.jpg": 213,
	"architecture-01.jpg": 214,
	"intro-portrait.jpg": 215,
}

PHOTO_PARENTS = {207: 311, 208: 311, 209: 311}


def main() -> None:
	posts: list[dict] = []

	def add_post(
		pid: int,
		title: str,
		slug: str,
		cats: list[str],
		excerpt: str,
		content: str,
		thumb: int | None,
		days_ago: int,
		meta: dict | None = None,
		tags: list[str] | None = None,
	) -> None:
		posts.append(
			{
				"id": pid,
				"title": title,
				"slug": slug,
				"cats": cats,
				"excerpt": excerpt,
				"content": content,
				"thumb": thumb,
				"days_ago": days_ago,
				"meta": meta or {},
				"tags": tags or [],
			}
		)

	add_post(
		301,
		"North of the last road",
		"north-of-the-last-road",
		["homepage-hero"],
		"Field note from the Cordillera: wet asphalt, pine, and cloud that erases the upper slopes.",
		prose(
			"The road leaves the valley without ceremony. One moment there are houses, bright signs and tricycles moving between market stalls; the next, everything narrows to wet asphalt and pine.",
			"By six in the morning, cloud had erased the upper slopes. We drove with the windows open, listening for water in the gullies and the low mechanical complaint of buses climbing somewhere ahead.",
			"This is where the journal begins: not at a destination, but at the moment the map stops being useful.",
		),
		201,
		0,
		meta={
			"sm_location": "Cordillera, Luzon",
			"sm_coordinates": "17.0832° N\n120.8995° E",
			"sm_conditions": "Rain / 18°C",
		},
		tags=["Leon Rivera"],
	)

	add_post(
		302,
		"The long road north",
		"the-long-road-north",
		["journeys"],
		"Three days through rain, mountain roads and towns that disappear into cloud before noon.",
		prose(
			"Three days on the road north is long enough to forget what flat ground feels like. The rain arrives in sheets, then softens into mist that hangs between the pines.",
			"Towns appear as brief brightness — a market, a church facade, steam from coffee — then fold back into the ridge. By the second afternoon we had stopped asking how much farther.",
			"What remains is the sound of water in the gullies and the sense that the mountains are reading us as carefully as we are reading them.",
		),
		202,
		1,
		meta={
			"sm_location": "Cordillera, Luzon",
			"sm_coordinates": "17.0832° N\n120.8995° E",
			"sm_conditions": "Rain / 18°C",
		},
		tags=["Leon Rivera"],
	)

	add_post(
		303,
		"Before the rain",
		"before-the-rain",
		["field-notes"],
		"The hour when everything holds still.",
		prose(
			"There is an hour, just before the weather breaks, when the light turns metallic and the leaves stop moving.",
			"We waited it out under a corrugated overhang, sharing coffee that had gone lukewarm, watching the valley gather itself.",
		),
		203,
		2,
	)

	add_post(
		304,
		"The road to the coast",
		"the-road-to-the-coast",
		["field-notes"],
		"Following the river until it finds the sea.",
		prose(
			"The river does not hurry. It cuts, revises, and eventually arrives.",
			"We followed it east until the air smelled of salt and the road finally remembered how to be level.",
		),
		204,
		3,
	)

	add_post(
		305,
		"Sierra Madre",
		"sierra-madre-range",
		["places"],
		"A range facing the Pacific. The spine of the eastern islands, and the reason this journal has a name.",
		prose(
			"Named for the mother range that faces the Pacific, this journal takes its bearings from ridgelines that hold weather, memory, and the roads between them.",
			"To write from here is to accept that the landscape was already speaking long before we arrived with notebooks.",
		),
		205,
		4,
	)

	add_post(
		306,
		"Aurora",
		"aurora",
		["places"],
		"Where the road meets the sea.",
		prose(
			"Aurora is where the mountain finally loosens its grip and the Pacific takes over the horizon.",
			"Fishermen mend nets in the same light that turns the foothills blue by late afternoon.",
		),
		204,
		5,
	)

	add_post(
		307,
		"Benguet",
		"benguet",
		["places"],
		"Mornings above the clouds.",
		prose(
			"In Benguet the mornings begin above the clouds. The valley is a rumor until the sun burns through.",
			"Vegetable terraces step down the slopes like a patient argument with gravity.",
		),
		203,
		6,
	)

	add_post(
		308,
		"Ifugao",
		"ifugao",
		["places"],
		"Stone walls, rice, and weather that arrives on schedule.",
		prose(
			"Ifugao keeps time in water. The terraces hold the season the way a journal holds a line.",
			"Walk the dikes early and you hear the mountain before you see it.",
		),
		206,
		7,
	)

	add_post(
		309,
		"Quezon",
		"quezon",
		["places"],
		"Coconut shade and roads that prefer the long curve.",
		prose(
			"Quezon prefers the long curve. Coconut shade, roadside stalls, and the sense that haste is a foreign dialect.",
			"We stopped more than we planned to. That was the point.",
		),
		214,
		8,
	)

	add_post(
		310,
		"Cagayan",
		"cagayan",
		["places"],
		"Wide sky at the edge of the archipelago.",
		prose(
			"Cagayan opens like a held breath — wider sky, longer horizons, fewer interruptions.",
			"It is a good place to end a journey, or to begin the next one without announcing it.",
		),
		215,
		9,
	)

	add_post(
		311,
		"Weather, passing.",
		"weather-passing",
		["photography"],
		"Light moves. The mountains stay. Three frames from the eastern range.",
		prose(
			"A photo essay is not a proof of place. It is a record of attention — three frames where light moved and the mountains did not.",
			"Shot across a single wet morning in eastern Luzon, from the road to the ridge and into the hour after rain.",
		),
		207,
		10,
		tags=["Leon Rivera"],
	)

	add_post(
		312,
		"The people who know the mountains",
		"the-people-who-know-the-mountains",
		["people"],
		"A morning with Mara Villanueva, and thirty years of listening to the ridgelines.",
		prose(
			"Mara Villanueva has spent thirty years listening to the ridgelines — not as metaphor, but as work.",
			"We met before sunrise. She spoke about weather the way other people speak about family: with familiarity, respect, and the occasional joke.",
		),
		210,
		11,
		tags=["Mara Villanueva"],
	)

	add_post(
		313,
		"At the table",
		"at-the-table",
		["culture"],
		"Mountain rice, sharp coffee, and the stories that begin with a shared breakfast.",
		prose(
			"Breakfast in La Trinidad is an editorial meeting disguised as a meal.",
			"Mountain rice, sharp coffee, and the understanding that the best stories start when nobody is performing yet.",
		),
		211,
		12,
	)

	add_post(
		314,
		"In transit",
		"in-transit",
		["movement"],
		"142 kilometres, seven hours, and everything that happens between departure and arrival.",
		prose(
			"One hundred forty-two kilometres. Seven hours. Enough time for the landscape to change its mind twice.",
			"Transit is not empty space between stories. It is where the notebook fills itself.",
		),
		212,
		13,
	)

	add_post(
		315,
		"Field Journal 01",
		"field-journal-01",
		["issues"],
		"Stories and photographs from across the islands.",
		prose(
			"Field Journal 01 gathers roads, ridges, and rain into a single issue — stories and photographs from across the islands.",
			"It is less a finished statement than an invitation to keep going.",
		),
		213,
		14,
	)

	pages = [
		{
			"id": 401,
			"title": "About",
			"slug": "about",
			"excerpt": "An independent field journal about landscapes, movement, memory and the people who understand a place by living inside it.",
			"content": prose(
				"Sierra Madre is an independent field journal about landscapes, movement, memory and the people who understand a place by living inside it.",
				"We travel to pay attention. The homepage, the archive, and every long story are built for that pace.",
			),
			"days_ago": 20,
			"cats": [],
			"tags": [],
			"thumb": None,
			"meta": {},
		}
	]

	lines: list[str] = []
	a = lines.append

	a('<?xml version="1.0" encoding="UTF-8" ?>')
	a("<!-- Generated for Sierra Madre curated homepage demo content. -->")
	a("<!-- Import via Tools, Import, WordPress after activating the theme. -->")
	a("<!-- Attachment URLs use 127.0.0.1 so Local PHP can download images. -->")
	a("<!-- Regenerate with: python3 bin/generate-demo-wxr.py -->")
	a(f"<!-- Media base: {THEME_IMG} -->")
	print(f"Media base: {THEME_IMG}")
	a('<rss version="2.0"')
	a('\txmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"')
	a('\txmlns:content="http://purl.org/rss/1.0/modules/content/"')
	a('\txmlns:wfw="http://wellformedweb.org/CommentAPI/"')
	a('\txmlns:dc="http://purl.org/dc/elements/1.1/"')
	a('\txmlns:wp="http://wordpress.org/export/1.2/"')
	a(">")
	a("<channel>")
	a("\t<title>Sierra Madre</title>")
	a(f"\t<link>{SITE}</link>")
	a("\t<description>Curated demo content for the Sierra Madre theme</description>")
	a(f"\t<pubDate>{rfc2822(BASE)}</pubDate>")
	a("\t<language>en-US</language>")
	a("\t<wp:wxr_version>1.2</wp:wxr_version>")
	a(f"\t<wp:base_site_url>{SITE}</wp:base_site_url>")
	a(f"\t<wp:base_blog_url>{SITE}</wp:base_blog_url>")

	a(
		"\t<wp:author><wp:author_id>1</wp:author_id>"
		"<wp:author_login><![CDATA[admin]]></wp:author_login>"
		"<wp:author_email><![CDATA[field@sierramadre.example]]></wp:author_email>"
		"<wp:author_display_name><![CDATA[Field Desk]]></wp:author_display_name>"
		"<wp:author_first_name><![CDATA[Field]]></wp:author_first_name>"
		"<wp:author_last_name><![CDATA[Desk]]></wp:author_last_name></wp:author>"
	)

	for _tid, name, slug in CATEGORIES:
		a(
			f"\t<wp:category><wp:term_id>{_tid}</wp:term_id>"
			f"<wp:category_nicename>{slug}</wp:category_nicename>"
			"<wp:category_parent></wp:category_parent>"
			f"<wp:cat_name>{cdata(name)}</wp:cat_name></wp:category>"
		)

	tag_id = 50
	tag_map: dict[str, int] = {}
	for post in posts:
		for tag in post["tags"]:
			if tag not in tag_map:
				tag_map[tag] = tag_id
				slug = tag.lower().replace(" ", "-")
				a(
					f"\t<wp:tag><wp:term_id>{tag_id}</wp:term_id>"
					f"<wp:tag_slug>{slug}</wp:tag_slug>"
					f"<wp:tag_name>{cdata(tag)}</wp:tag_name></wp:tag>"
				)
				tag_id += 1

	def item_attachment(aid: int, filename: str, parent: int = 0, days_ago: int = 25) -> None:
		dt = BASE - timedelta(days=days_ago)
		title = filename.rsplit(".", 1)[0].replace("-", " ")
		url = f"{THEME_IMG}/{filename}"
		a("\t<item>")
		a(f"\t\t<title>{escape(title)}</title>")
		a(f"\t\t<link>{url}</link>")
		a(f"\t\t<pubDate>{rfc2822(dt)}</pubDate>")
		a("\t\t<dc:creator>admin</dc:creator>")
		a(f'\t\t<guid isPermaLink="false">{url}</guid>')
		a("\t\t<description></description>")
		a("\t\t<content:encoded><![CDATA[]]></content:encoded>")
		a("\t\t<excerpt:encoded><![CDATA[]]></excerpt:encoded>")
		a(f"\t\t<wp:post_id>{aid}</wp:post_id>")
		a(f"\t\t<wp:post_date>{mysql_dt(dt)}</wp:post_date>")
		a(f"\t\t<wp:post_date_gmt>{mysql_dt(dt)}</wp:post_date_gmt>")
		a("\t\t<wp:comment_status>closed</wp:comment_status>")
		a("\t\t<wp:ping_status>closed</wp:ping_status>")
		a(f"\t\t<wp:post_name>{filename}</wp:post_name>")
		a("\t\t<wp:status>inherit</wp:status>")
		a(f"\t\t<wp:post_parent>{parent}</wp:post_parent>")
		a("\t\t<wp:menu_order>0</wp:menu_order>")
		a("\t\t<wp:post_type>attachment</wp:post_type>")
		a("\t\t<wp:post_password></wp:post_password>")
		a("\t\t<wp:is_sticky>0</wp:is_sticky>")
		a(f"\t\t<wp:attachment_url>{url}</wp:attachment_url>")
		a(
			"\t\t<wp:postmeta><wp:meta_key><![CDATA[_wp_attached_file]]></wp:meta_key>"
			f"<wp:meta_value>{cdata(f'{dt.year}/{dt.month:02d}/{filename}')}</wp:meta_value></wp:postmeta>"
		)
		a("\t</item>")

	for filename, aid in IMAGES.items():
		item_attachment(aid, filename, parent=PHOTO_PARENTS.get(aid, 0))

	def emit_item(p: dict, post_type: str = "post") -> None:
		dt = BASE - timedelta(days=p["days_ago"])
		a("\t<item>")
		a(f'\t\t<title>{cdata(p["title"])}</title>')
		a(f'\t\t<link>{SITE}/{p["slug"]}/</link>')
		a(f"\t\t<pubDate>{rfc2822(dt)}</pubDate>")
		a("\t\t<dc:creator>admin</dc:creator>")
		a(f'\t\t<guid isPermaLink="false">{SITE}/?p={p["id"]}</guid>')
		a("\t\t<description></description>")
		a(f'\t\t<content:encoded>{cdata(p["content"])}</content:encoded>')
		a(f'\t\t<excerpt:encoded>{cdata(p["excerpt"])}</excerpt:encoded>')
		a(f'\t\t<wp:post_id>{p["id"]}</wp:post_id>')
		a(f"\t\t<wp:post_date>{mysql_dt(dt)}</wp:post_date>")
		a(f"\t\t<wp:post_date_gmt>{mysql_dt(dt)}</wp:post_date_gmt>")
		a("\t\t<wp:comment_status>closed</wp:comment_status>")
		a("\t\t<wp:ping_status>closed</wp:ping_status>")
		a(f'\t\t<wp:post_name>{p["slug"]}</wp:post_name>')
		a("\t\t<wp:status>publish</wp:status>")
		a("\t\t<wp:post_parent>0</wp:post_parent>")
		a("\t\t<wp:menu_order>0</wp:menu_order>")
		a(f"\t\t<wp:post_type>{post_type}</wp:post_type>")
		a("\t\t<wp:post_password></wp:post_password>")
		a("\t\t<wp:is_sticky>0</wp:is_sticky>")
		for cat_slug in p.get("cats", []):
			cat_name = next(n for _i, n, s in CATEGORIES if s == cat_slug)
			a(
				f'\t\t<category domain="category" nicename="{cat_slug}">'
				f"{cdata(cat_name)}</category>"
			)
		for tag in p.get("tags", []):
			slug = tag.lower().replace(" ", "-")
			a(
				f'\t\t<category domain="post_tag" nicename="{slug}">'
				f"{cdata(tag)}</category>"
			)
		if p.get("thumb"):
			a(
				"\t\t<wp:postmeta><wp:meta_key><![CDATA[_thumbnail_id]]></wp:meta_key>"
				f'<wp:meta_value>{cdata(str(p["thumb"]))}</wp:meta_value></wp:postmeta>'
			)
		for key, value in p.get("meta", {}).items():
			a(
				f"\t\t<wp:postmeta><wp:meta_key>{cdata(key)}</wp:meta_key>"
				f"<wp:meta_value>{cdata(value)}</wp:meta_value></wp:postmeta>"
			)
		a("\t</item>")

	for post in posts:
		emit_item(post)

	for page in pages:
		emit_item(page, post_type="page")

	a("</channel>")
	a("</rss>")

	OUT.parent.mkdir(parents=True, exist_ok=True)
	OUT.write_text("\n".join(lines) + "\n", encoding="utf-8")
	print(f"Wrote {OUT} ({OUT.stat().st_size} bytes)")
	print(
		f"Posts: {len(posts)}, pages: {len(pages)}, "
		f"attachments: {len(IMAGES)}, categories: {len(CATEGORIES)}"
	)


if __name__ == "__main__":
	main()
