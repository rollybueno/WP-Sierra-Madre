# Sierra Madre prototype pattern audit

The audit covers every supplied prototype: `index.html`, `page.html`, `single.html`, `archive.html`, `search.html`, and `404.html`.

## Recommended reusable patterns (21)

### Front page (13)

1. Homepage hero
2. Opening notes
3. Featured journey
4. Field notes listing
5. Featured place
6. Photo essay
7. Field log
8. People / conversation feature
9. Transit feature
10. Culture / table story
11. Places index
12. Journal issue promotion
13. Newsletter signup

### General and About pages (5)

14. Editorial page introduction
15. Panoramic image
16. Manifesto / text feature
17. Numbered principles
18. Contributors feature with contact call-to-action

### Story-editor layouts (3)

19. Article section with field-note sidebar
20. Full-width captioned image
21. Image diptych

## Template parts, not patterns

- Header
- Footer
- Menu and search overlays, which are structural parts of the header

## Template-bound compositions, not patterns

- Archive heading, filters, inherited Query Loop, and pagination
- Search heading, search form, inherited Query Loop, and pagination
- Single-post hero, post metadata, terms, and previous/next navigation
- 404 composition

Archive cards and search-result rows belong inside their Query Loop Post Templates. They should not become separately registered patterns.

## Planned architecture

| Type | Count |
|---|---:|
| Template parts | 2 |
| Primary templates | 6 |
| Reusable patterns | 21 |
| Query/Post Template compositions | 4 |
| Custom blocks | 0 |

Patterns are regular, unsynced patterns unless content must remain globally identical. The newsletter is the main candidate for a synced pattern after its final form and integration are known.
