# W-min159 — phlix-plugin-void-bloom-theme minors — LANDED

Queue map (grep-derived, trust-above-belief): W-min159 = {M-THEME-VOID-BLOOM-04, -05, -07}.
Era note: IDs are the MINORS-queue literals; same-literal MAJORS were CLOSED era — not touched here. Bracket tags `[M-THEME-VOID-BLOOM-NN]` in the nine prior minors commits (2eff54a..46d47ce) use that lane's own ordering, NOT the queue numbering — items were matched to disk by CONTENT, not by tag.

Baseline gates at tip 46d47ce (first green run, measure reference): phpunit 53 tests / 348 assertions OK — the estate "XML-deprecated notice" venue note is NOT applicable on this tip (resolved pre-lane by 74c3b5c; srphp INFO-1 concurs); phpstan L9 (src+tests, zero ignores) [OK]; phpcs --standard=phpcs.xml clean; bare PSR12 on changed files clean.

## Items

| id | disposition | evidence |
|----|-------------|----------|
| M-THEME-VOID-BLOOM-04 — `--accent-text` value breaks lineage semantics | STALE-VERIFIED | Already cured on disk at `b561c07` (`#ffffff` → `#ff6b6b`, cat-file + merge-base-ancestor proven, no -q). Content proof: `src/VoidBloomPlugin.php` ships `'--accent-text' => '#ff6b6b'` — the queue's own fix-essence value; pinned by `TokenContrastTest::testAccentTextIsTheAccentHueAsForeground` (saturation law) + AA-foreground law, and documented in the README `--accent-text` row (6.01–7.34:1). Value move was owner-cohort-ratified lineage (cohort trap settle @ 46d47ce). |
| M-THEME-VOID-BLOOM-05 — test hygiene: dead fallback assertion, duplicated token sweep, mixed naming | LIVE-CURED (this batch) | Residual on disk (the `assertTrue(true)` legs had already gone in `e5456ef`, verified absent): two near-identical sweeps (`tokensAreValidCssColorValues` 28× non-empty; `testAllTokensAreValidCssValues` 28× {non-empty, no-`var(`, no-`url(`}) — neither validates grammar despite claiming color validity; 15 `it*`/bare names vs `test*` one; repeated `$themes[0] ?? null` + `assertNotNull` guards. Cured: ONE sweep `testAllTokenValuesMatchTheHostTokenGrammar` mirroring host `ThemeTokenValidator::isSafeValue` families verbatim (HEX_PATTERN :106, FUNCTION_PATTERN :122 + ARGUMENT, NUMBER_PATTERN :114, KEYWORDS :136, MAX_VALUE_LENGTH :101 — cited in the file docblock; mirror is forced: plugin CI has no server package); `var()`/`url()` indirection is grammar-implied-rejected (no family admits them — explicit bans subsumed). One naming convention: all methods camelCase `test*` (+ #[Test], matching TokenContrastTest/SecurityAuditCheckTest voices). Token reads via a single `themeTokens()` boundary helper. Raw: scratch probe planted `'--vignette' => 'var(--black)'` → sweep RED at the grammar assert (`/tmp/opencode/fix-void159/probe`, "Tests: 1, Assertions: 66, Failures: 1"), reverted; real tree GREEN 52 tests / 311 assertions (−1 test exact = merged pair; 348→311 measured, the removed 121 guard/dup assertions vs 56 length+grammar assertions + 3 absorbed structural pins). |
| M-THEME-VOID-BLOOM-07 — README overclaims (token table + "Seamless") | SPLIT: table STALE-VERIFIED @46d47ce; phrase LIVE-CURED (this batch) | Table gap cured pre-lane: README now carries 28 rows naming every shipped custom property (glass layers, `--accent-ring`/`-hover`/`-active`, `--text-on-accent`, all five `--color-*` aliases included) — verified row-set vs `src/VoidBloomPlugin.php` token map, values byte-exact. Residual the webux review paired with it — the bare "Seamless extension of the midnight base theme" bullet — reworded to the checkable override/inheritance statement (28 listed = what it overrides; the rest inherits `midnight`). The review's "Deep shadows" bullet complaint is queue item -11 (W-min160 batch), cured there, not here. |

## Gate outputs at close (this batch)

- phpunit: OK (52 tests, 311 assertions) — coverage.xml still written (cobertura leg intact).
- phpstan analyse -c phpstan.neon: [OK] No errors (level 9, tests/ included, ZERO ignores added).
- phpcs --standard=phpcs.xml: exit 0; bare PSR12 on changed files: exit 0 (no ScopeIndent class issues).
- S440 bright-line: `scripts/security-audit-check.php` + `tests/SecurityAuditCheckTest.php` ZERO-DIFF (git diff shows only README.md + tests/VoidBloomPluginTest.php touched).
- Stale sha proofs: b561c07, 46d47ce, e5456ef — `cat-file -e` + `merge-base --is-ancestor` vs HEAD (no -q).

## Verdict —

All three W-min159 items terminal on disk: one fully stale-verified with content proof, one live-cured with a mutation-toothed red-then-green probe, one split-cured (stale table + live phrase). Suite holds green with tighter law than the baseline it started from.

verdict:LANDED
