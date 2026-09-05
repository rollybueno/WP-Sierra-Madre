#!/usr/bin/env bash
# Import curated demo content via WP-CLI, sideloading images from disk
# (avoids Local *.local DNS failures in the browser importer).
set -euo pipefail

THEME_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WP_ROOT="$(cd "${THEME_ROOT}/../../../.." && pwd)"
WXR="${THEME_ROOT}/demo-content/sierra-madre-curated.xml"
IMG_DIR="${THEME_ROOT}/assets/images"

if ! command -v wp >/dev/null 2>&1; then
	echo "error: wp-cli (wp) is required" >&2
	exit 1
fi

if [[ ! -f "${WXR}" ]]; then
	echo "error: missing ${WXR} — run python3 bin/generate-demo-wxr.py first" >&2
	exit 1
fi

cd "${WP_ROOT}"

echo "Regenerating WXR with loopback media URLs…"
python3 "${THEME_ROOT}/bin/generate-demo-wxr.py"

echo "Importing WXR (download attachments)…"
wp import "${WXR}" --authors=create --quiet

echo "Done. If any media still failed, sideload key images:"
echo "  wp media import ${IMG_DIR}/hero-01.jpg --porcelain"
