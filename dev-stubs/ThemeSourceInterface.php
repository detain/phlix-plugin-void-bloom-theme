<?php

/**
 * Dev-only stub of the host server's theme-source contract.
 *
 * @copyright 2026 Joe Huss <detain@interserver.net>
 * @license   MIT
 */

declare(strict_types=1);

namespace Phlix\Theming;

/**
 * Dev-only stub of `Phlix\Theming\ThemeSourceInterface`.
 *
 * Unlike `LifecycleInterface`, this contract does **not** live in
 * `detain/phlix-shared` — it is declared by the host server at
 * `src/Theming/ThemeSourceInterface.php` and is on the classpath only inside a
 * running Phlix server. Composer therefore cannot supply it, so the plugin's
 * own suite and its PHPStan run need this minimal, signature-compatible copy.
 *
 * `tests/bootstrap.php` loads it only when the real interface is absent, and
 * `phpstan.neon` picks it up through `scanDirectories` (which INTRODUCES a
 * symbol; `stubFiles` would only override one PHPStan can already resolve, and
 * is silently useless for a symbol it cannot find at all).
 *
 * ## Payload shape (host text, verbatim)
 *
 * `providedThemes()` returns raw arrays, not objects, so a plugin can build
 * them from its own JSON without depending on a host value class:
 *
 * ```php
 * [
 *     'id'      => 'acme-noir',        // lowercase slug, unique, not a reserved built-in id
 *     'name'    => 'Acme Noir',        // 1..64 chars, no control characters
 *     'dark'    => true,               // strictly boolean
 *     'extends' => null,               // optional base theme id
 *     'tokens'  => [                   // keys MUST be on ThemeTokenAllowlist
 *         '--bg'      => '#08070a',
 *         '--surface' => '#12111a',
 *         '--accent'  => 'rgba(120, 190, 255, 0.95)',
 *     ],
 * ]
 * ```
 *
 * Every payload is validated by `ThemeTokenValidator` before it is registered.
 * Validation is fail-closed and all-or-nothing: one bad token rejects the
 * entire source (and, on the enable path, fails the plugin enable) rather than
 * silently dropping a theme.
 *
 * Keep in sync with the host definition if that contract ever changes.
 *
 * @internal Tests/analysis only — never autoloaded into production.
 */
interface ThemeSourceInterface
{
    /**
     * The canonical, stable name of this theme source.
     */
    public function themeSourceName(): string;

    /**
     * The raw theme payloads this source contributes.
     *
     * Must be cheap and non-blocking — see the class docblock. Return an
     * empty list to contribute nothing (a source that is currently
     * unconfigured, say); that is a valid, leak-free registration.
     *
     * @return list<array<array-key, mixed>> Raw payloads in the shape
     *         documented on this interface; each is validated by the host.
     */
    public function providedThemes(): array;
}
