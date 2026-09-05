#!/usr/bin/env bash
# Build a WordPress.org-ready theme zip using .distignore exclusions.
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

SLUG="sierra-madre"
DISTIGNORE="${ROOT}/.distignore"
OUT_DIR="${ROOT}/dist"
STAGE="${OUT_DIR}/${SLUG}"

VERSION="$(
	sed -n 's/^Version:[[:space:]]*//p' style.css | head -n1 | tr -d '\r'
)"
if [[ -z "${VERSION}" ]]; then
	echo "error: could not read Version from style.css" >&2
	exit 1
fi

ZIP_NAME="${SLUG}-${VERSION}.zip"
ZIP_PATH="${OUT_DIR}/${ZIP_NAME}"

if [[ ! -f "${DISTIGNORE}" ]]; then
	echo "error: missing .distignore" >&2
	exit 1
fi

mkdir -p "${OUT_DIR}"
rm -rf "${STAGE}"
mkdir -p "${STAGE}"

# Stage theme files, excluding development-only paths from .distignore.
rsync -a \
	--delete \
	--exclude-from="${DISTIGNORE}" \
	--exclude 'dist/' \
	--exclude 'bin/' \
	./ "${STAGE}/"

rm -f "${ZIP_PATH}"
(
	cd "${OUT_DIR}"
	zip -rq "${ZIP_NAME}" "${SLUG}"
)

rm -rf "${STAGE}"

BYTES="$(wc -c < "${ZIP_PATH}" | tr -d ' ')"
echo "Built ${ZIP_PATH} (${BYTES} bytes)"
