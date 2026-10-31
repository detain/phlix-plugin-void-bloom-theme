# W-min161 — phlix-plugin-void-bloom-theme minors — LANDED (with one OWNER-PARK)

Queue map: W-min161 = {M-THEME-VOID-BLOOM-06, -12}.
Era note: minors-space IDs; majors same literals CLOSED era. Prior-lane bracket tags ≠ queue numbering (content-matched); W-min159 landed 6551c1e, W-min160 landed d9eb71e (both origin-verified).

Baseline from tip d9eb71e (measure reference): phpunit OK (52 tests, 311 assertions); phpstan L9 [OK] zero ignores; phpcs repo-surface clean; no XML-deprecated notice on this tip (pre-existing-note family item N/A here — resolved estate-wide by 74c3b5c pre-lane, srphp INFO-1 concurs).

## Items

| id | disposition | evidence |
|----|-------------|----------|
| M-THEME-VOID-BLOOM-06 — legacy alias law: 17 orphaned `--color-*` halves — TOKEN VALUES | **OWNER-PARK** (value move, owner-gated per venue law) | The pairing law is real and quoted: server `BuiltInThemes.php:62-66` — flattening loses `--color-bg: var(--bg)` follow-through, so "a plugin theme that extends a built-in and overrides one half of such a pair should set both". This payload ships 5 of the 22 legacy keys (enumerated from the server map, exact set-diff): orphans `--color-border-subtle, --color-error, --color-error-bg, --color-info, --color-info-bg, --color-primary, --color-primary-active, --color-primary-hover, --color-success, --color-success-bg, --color-surface-active, --color-surface-elevated, --color-surface-hover, --color-text-secondary, --color-text-subtle, --color-warning, --color-warning-bg` = 17 ✓ (matches the review's count verbatim). Blasted values: midnight's amber primary trio + warm-tinted neutrals inside a neutral-coral palette; wire consumers today are `phlix-ui/src/dev/swatches.html` + unreferenced legacy `public/assets/css/*` (review-verified ZERO live-web blast radius — latent). CURE ASKED OF OWNER: append the 17 keys to the `providedThemes()` token map byte-mirroring their modern twins where one ships (`--color-primary{,-hover,-active}` ← `--accent{,-hover,-active}` coral trio; `--color-text-subtle/-secondary` ← `--text-subtle` #9c948a / `--text-muted` #c9c2b8 per the built-in equality webux names; `--color-surface-{hover,elevated,active}`, `--color-border-subtle` ← the shipped surface/border tiers), and rule on the four semantic states `--color-{error,info,success,warning}{,-bg}` for which the theme ships no modern twin (explicit vs inherit midnight — designer's call). NOT applied here: token VALUE moves are owner-gated in this lane's venue. README's aliases section is already honest about the 17 ("they inherit midnight") — no prose lie to cure. |
| M-THEME-VOID-BLOOM-06 — test enshrining the wrong spec | LIVE-CURED (this batch) | webux: "`itProvidesRequiredColorTokens` enshrines the 5-key half-set as 'required', cementing the wrong spec". `testProvidesRequiredColorTokens` → `testProvidesDocumentedLegacyColorAliases`; the bare "Core color tokens" comment replaced by a docblock that states exactly what is pinned (the shipped-and-documented 5-key subset), cites the pairing law file:lines, and cross-refs this report's owner-park for the 17. Assertions unchanged — the pin now describes reality instead of canonizing the gap. |
| M-THEME-VOID-BLOOM-12 (a,b,e) — grammar group residuals | LIVE-CURED (this batch) | (a) `MIT License - see LICENSE` → em-dash (estate prose altitude, README License line). (b) palette fence: intent note added under "## Color Palette" — "deliberately a language-less plain fence — ASCII art, not code; do not let a linter 'fix' it" (review's own remedy, prose-level; fence bytes untouched). (e) `@package Phlix\VoidBloom` added to the class docblock — family-docs parity proven: sample `@package Phlix\PluginSampleTheme` (:90), jade `@package Phlix\Jade` (:25), obsidian `@package Phlix\ObsidianFlame` (:25); the review itself graded it "not a defect per se" — cured as the zero-risk drift-closer. |
| M-THEME-VOID-BLOOM-12 (c) — "tests/VoidBloomPluginTest.php mixes naming voices: fourteen it\* methods vs testAllTokensAreValidCssValues" | STALE-VERIFIED | Cured pre-lane by THIS vein's W-min159 landing `6551c1e` (single camelCase `test*` convention + #[Test] attr). Disk proof at tip: `grep -c "function it[A-Z]" tests/VoidBloomPluginTest.php` = 0; `grep -c "function test[A-Z]"` = 16. No double-credit: the 159 report already banks this exact sub-cure; recorded here only as item-12's dependency. |
| M-THEME-VOID-BLOOM-12 (d) — "the two share the comment 'Each token value should be a valid CSS color' that overstates" | STALE-VERIFIED | Same 159 rewrite (merged grammar sweep made the false-name sweeps moot). Disk proof: `grep -c "should be a valid CSS color" tests/VoidBloomPluginTest.php` = 0. |

## Gate outputs at close (this batch)

- phpunit: OK (52 tests, 311 assertions) — counts identical to baseline (rename/docblock/prose-only, zero behavior change — no red-probe applies; disclosed rather than performed).
- phpstan analyse -c phpstan.neon: [OK] No errors (level 9, zero ignores added).
- phpcs --standard=phpcs.xml exit 0; bare PSR12 on changed PHP files exit 0.
- S440 bright-line: `git diff -- scripts/ tests/SecurityAuditCheckTest.php` = 0 lines.
- VEIN-DONE check: awk over queue block → void-bloom batch rows are exactly {W-min159:3, W-min160:7, W-min161:2} = all 12 items; W26/W33/W40 roster lines list no W-min162+ void batch. Nothing further queued for this vein.

## Verdict —

W-min161 terminal: item -06 split — its test-spec enshrinement cured in-lane, its 17-token value completion HONEST-PARKED for the owner with the exact key set, law quote, and candidate twin-mapping prepared; item -12 fully closed (three live prose/docblock cures, two sub-claims stale-verified against our own 6551c1e). VOID vein 159-161 now exhausted — queue says nothing further for this repo.

verdict:LANDED
