# TW-072 — phlix-plugin-void-bloom-theme README truth (alias rationale + bare-directory claim) — LANDED

Queue map: w11 L6 = {TW-072} — anchors theme-void-bloom__combined.md#5[Minor] + #6[Minor], both `README.md` prose. Card: "README truth: alias rationale and bare-directory claim"; deps TW-071 landed earlier at 47665bc9.
Baseline from tip 47665bc92d (disk tip = origin, re-verified same-turn via fetch before edits): phpunit OK (52 tests, 311 assertions); phpstan L9 [OK]; phpcs exit 0; no XML-deprecated-schema notice fired at this tip (pre-existing carry class — disclosed, not chased).

## Items

| id | disposition | evidence |
|----|-------------|----------|
| #5[Minor] — README:57 "The five keys the built-in generation still reads" misattributes who reads the five keys | LIVE-CURED (this batch) | Confirmed at current tips. `phlix-server` `src/Theming/BuiltInThemes.php` at origin master `a63dc0db` DECLARES all 22 `--color-*` aliases per built-in payload (`:155-176` — the midnight block, 22 lines) and does not "read five"; the class docblock `:62-66` states the actual governing law verbatim: a theme overriding one half of a flattened pair "should set both, which is why both halves are on the allowlist" (pairing rule). Live `var()` readers re-measured at CURRENT ui tip `eb9e991c` (HEAD==origin/master same-turn): `phlix-tokens` `src/css/index.css:31-32` consumes `--color-bg`/`--color-text`; `phlix-ui` `PhotoViewPage.vue` (`:353-354,412,457,458,475,476,558`) + `PhotoAlbumsPage.vue` (`:296,308,313,324`) consume `--color-surface`/`--color-border` (+`--color-bg`); `grep -rn 'var(--color-text-muted)' src/` across phlix-ui and phlix-tokens = zero non-dev readers estate-wide (review's figure reproduced). README now justifies the five by the pairing rule (each mirrors a modern twin Void Bloom overrides — plugin's own `extends: midnight` at `src/VoidBloomPlugin.php:78`), names the live readers, and flags `--color-text-muted` as pair-completeness-only. No raw census numbers introduced — qualitative claims only, per the review's second recommendation. |
| #6[Minor] — README:137-138 "installs catalog-pinned archives or local tarballs, never an ambient vendor checkout or a bare directory" overstates the loader | LIVE-CURED (this batch) | Confirmed: `PluginLoader::installFromDirectory()` at `phlix-server` origin master `a63dc0db` `src/Plugins/PluginLoader.php:175-179` does stage a bare directory (docblock: "Mostly used by integration tests and operator-side `dev install` workflows"), and it — like `install()` — writes the DB row via `finalizeInstall()` (`:183-187`: "version check, signature check, composer install, DB insert, audit log"). Estate grep: no console command wraps `installFromDirectory` (`src/Console/Commands/PluginInstallCommand.php` takes a source URL; other callers are tests/), so the escape is explicit-programmatic, not ambient. README claim re-scoped exactly per the review's recommendation: "registers nothing by itself / no ambient path auto-registers", the dev-install directory route named honestly (mirroring how the local-tarball paragraph already discloses `file://`), and the user-facing conclusion (a clone in `vendor/` or the plugins dir does nothing until an install is triggered) kept. |

## Notes

- Theme CSS/JSON payload untouched — no palette VALUE moves (VOID-06 owner-park class not implicated). README prose only; +21/-6, single file.
- Sibling-echo sweep: `grep -rn 'still reads|bare directory|five keys'` across src/tests/dev-stubs/docs — zero other sites carrying the retired sentences (only the new honest usage).
- Tip-drift note (per lane brief): consumer claims re-measured at ui `eb9e991c` (i18n leaf 526→531 era) — none of them are counts, so no re-anchor duty rides this change; the TW-071 test-census pins stay on the stable tag anchor `v0.99.22` by that lane's recorded rationale.

## Gate outputs at close (this batch)

- composer validate --strict: valid.
- phpunit: OK (52 tests, 311 assertions) — identical to baseline (prose-only change, zero behavior delta — disclosed rather than red-probed, per W-min161/TW-071 precedent).
- phpstan analyse -c phpstan.neon: [OK] No errors (level 9).
- phpcs --standard=phpcs.xml exit 0; no PHP file touched, so no bare-PSR12 test-file leg applies (recorded for honesty).
- S440 bright-line: `git diff -- scripts/ tests/SecurityAuditCheckTest.php .github/` = 0 lines.

## Verdict —

TW-072 terminal: both README overstatements cured against current host tips with file:line proofs — the five legacy aliases are now justified by the pairing law (not a fictional built-in "read"), and the install story tells the truth about the dev-directory route while keeping its honest headline: nothing ambient ever registers a plugin by itself.

verdict:LANDED
