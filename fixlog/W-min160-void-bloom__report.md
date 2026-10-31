# W-min160 — phlix-plugin-void-bloom-theme minors — LANDED

Queue map (grep-derived, trust-above-belief): W-min160 = {M-THEME-VOID-BLOOM-01, -02, -03, -08, -09, -10, -11}.
Repeated-ID artifact: -03 (srphp MIN-3) and -08 (writer m1) are the SAME finding (`.gitignore` still listed `composer.lock` while the S440 regime's first law is a committed lock) from two reviewer lanes — one cure closes both.
Era note: IDs are the MINORS-queue literals; same-literal MAJORS were CLOSED era — not touched here. Bracket tags in the nine prior minors commits (2eff54a..46d47ce) use that lane's own ordering, not the queue numbering — items matched to disk by CONTENT.
Reference: W-min159 landed as `6551c1e` (pushed, origin-verified same turn).

## Items

| id | disposition | evidence |
|----|-------------|----------|
| M-THEME-VOID-BLOOM-01 — CI asserts a coverage artifact its phpunit.xml never writes; Codacy step permanent theater | STALE-VERIFIED | Cured pre-lane at `16c0edc` (cat-file -e + merge-base --is-ancestor, no -q). Content proof on this tree: `phpunit.xml:14` carries `<cobertura outputFile="coverage.xml"/>` inside `<coverage><report>` (sample's block), `.gitignore:2` carries `/coverage.xml`, and the workflow comment at `test.yml:30` now states the truth — every local bare `vendor/bin/phpunit` run prints "Generating code coverage report in Cobertura XML format ... done" (observed in this lane's gate runs, both pre and post). The artifact the upload step consumes is real; the never-written-artifact failure mode (the "permanent theater") is gone. `continue-on-error` on the Codacy leg itself is the sanctioned token-optional upload posture (repo precedent: codecov legs made non-fatal estate-wide) and is outside this item's fix-essence, which offered "add the block OR delete comment+step" — the block was added. |
| M-THEME-VOID-BLOOM-02 — README mis-states which contract is host-only | LIVE-CURED (this batch) | `LifecycleInterface` is no longer mislabeled host-only: the Development paragraph now mirrors the sample's two-contract wording (README.md:280-281-era) — shared-published contract supplied by `composer install`; `ThemeSourceInterface` the host-only one declared by the server in no Composer package; plus the truthful stub-load law from `tests/bootstrap.php`. A reader trimming the shared dep can no longer be misled. |
| M-THEME-VOID-BLOOM-03 — `.gitignore` ignores `composer.lock` (S440 first law is a committed lock) | LIVE-CURED (this batch) | Line dropped. Guard-suite limbo closed: an untrack ceremony can no longer make the lock un-re-addable via `git add .`. Sample's post-lane .gitignore confirms removal (not `/`-prefixing) is the family cure. |
| M-THEME-VOID-BLOOM-08 — writer m1: `.gitignore` contradicts the committed-lock law | LIVE-CURED (this batch, SAME cure as -03) | Duplicate-ID artifact disclosed up top: one .gitignore line, two reviewer lanes, both closed by this diff. |
| M-THEME-VOID-BLOOM-09 — README Development omits the fourth, most-guarded CI gate | LIVE-CURED (this batch) | The same paragraph now names the S440 `composer-audit` job, its whole-lock scope (runtime AND dev), the local command `php scripts/security-audit-check.php`, the containment rules (bare run line / no continue-on-error / job LAST), and the fact that `tests/SecurityAuditCheckTest.php` polices them. Prose only — workflow bytes untouched; gate re-run locally green ("No security advisories affecting the 33 locked package(s)"; floor corpus unchanged). |
| M-THEME-VOID-BLOOM-10 — tests/bootstrap.php teaches a directory layout the repo doesn't have | STALE-VERIFIED | Dead `tests/phpunit/unit/` map + shadowing prepend autoloader removed pre-lane at `7653a89` (subject names the deletion; cat-file/merge-base proven). Content proof: `grep -c "phpunit/unit" tests/bootstrap.php` = 0 on this tree; current bootstrap is the sample's interface_exists-guarded shape. |
| M-THEME-VOID-BLOOM-11 — "Deep shadows" promise no surface substantiates | LIVE-CURED (this batch, prose — values not owner-gated-in-scope and, per webux, impossible: shadow tokens are host-baseline layout tokens outside the theme allowlist) | All four evidence-named surfaces rewritten: README:3 tagline, Features bullet (now checkable: names `--vignette` + four-tier stack, states shadows inherit from `midnight` and the theme "deepens nothing on its own"), composer.json description, `src/VoidBloomPlugin.php` class docblock. No token VALUE moved. `composer update --lock --no-install` confirmed the lock's content-hash ignores the description field — composer.lock diff ZERO lines (composer validate --strict green). |

## Gate outputs at close (this batch)

- phpunit: OK (52 tests, 311 assertions) — identical figures to the W-min159 landing (no test-file change here), coverage leg intact.
- phpstan analyse -c phpstan.neon: [OK] No errors (level 9, src+tests, zero ignores).
- phpcs --standard=phpcs.xml exit 0; bare PSR12 on the changed src file exit 0.
- S440 bright-line: `git diff -- scripts/ tests/SecurityAuditCheckTest.php` = 0 lines (auto-REWORK not tripped).
- composer validate --strict valid; scripts/security-audit-check.php green on the untouched committed lock.
- Owner/wire: nothing here needed an owner ask — zero wire codes, zero token values; prose/ignore/tests only.

## Verdict —

All seven W-min160 items terminal: two stale-verified with content proof against real ancestor shas (16c0edc, 7653a89), five live-cured — the .gitignore tripwire closing the -03/-08 duplicate pair with one line, the README Development paragraph rewritten once to serve both -02 and -09, and the shadow promise made checkable across its four surfaces without touching a single token value.

verdict:LANDED
