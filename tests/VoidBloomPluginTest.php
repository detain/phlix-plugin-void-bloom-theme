<?php

declare(strict_types=1);

namespace Phlix\VoidBloom\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\CoversClass;
use Phlix\VoidBloom\VoidBloomPlugin;

/**
 * Structural contract tests for the theme payload.
 *
 * Naming convention for this suite (and the repo's other test files,
 * `TokenContrastTest` and `SecurityAuditCheckTest`): one voice — camelCase
 * `test*` methods, each also carrying the #[Test] attribute.
 *
 * The token-grammar sweep mirrors the host's `ThemeTokenValidator::isSafeValue`
 * patterns (phlix-server src/Theming/ThemeTokenValidator.php: HEX_PATTERN,
 * FUNCTION_PATTERN + ARGUMENT, NUMBER_PATTERN, KEYWORDS, MAX_VALUE_LENGTH).
 * The mirror is deliberate: the plugin cannot depend on the server package in
 * standalone CI, so the same grammar is re-declared here and kept honest by
 * review. It supersedes the earlier pair of near-identical sweeps that only
 * checked non-emptiness (and, in one, banned `var()`/`url()`), never a real
 * CSS grammar despite claiming one in the name.
 */
#[CoversClass(VoidBloomPlugin::class)]
final class VoidBloomPluginTest extends TestCase
{
    /** Mirrors the host validator's MAX_VALUE_LENGTH. */
    private const MAX_VALUE_LENGTH = 128;

    /** Mirrors the host validator's HEX_PATTERN (`#rgb`, `#rgba`, `#rrggbb`, `#rrggbbaa`). */
    private const HEX_PATTERN =
        '/^#(?:[0-9A-Fa-f]{3}|[0-9A-Fa-f]{4}|[0-9A-Fa-f]{6}|[0-9A-Fa-f]{8})\z/';

    /** Mirrors the host validator's NUMBER_PATTERN (bare numbers like `0.035`). */
    private const NUMBER_PATTERN = '/^[+-]?(?:[0-9]+(?:\.[0-9]+)?|\.[0-9]+)\z/';

    /** Mirrors the host validator's ARGUMENT (one numeric color-function argument). */
    private const ARGUMENT = '[+-]?(?:[0-9]+(?:\.[0-9]+)?|\.[0-9]+)(?:%|(?i:deg))?';

    /** Mirrors the host validator's FUNCTION_PATTERN (`rgb()/rgba()/hsl()/hsla()`, 3–4 args). */
    private const FUNCTION_PATTERN =
        '/^(?i:rgba?|hsla?)\((?:[ ]*)' . self::ARGUMENT
        . '(?:(?:[ ]*)[,\/](?:[ ]*)' . self::ARGUMENT . '){2,3}(?:[ ]*)\)\z/';

    /** Mirrors the host validator's KEYWORDS accepted as a color value. */
    private const KEYWORDS = ['transparent', 'currentcolor'];

    private VoidBloomPlugin $plugin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->plugin = new VoidBloomPlugin();
    }

    /**
     * The shipped token map, parsed once at the test boundary.
     *
     * @return array<string, string>
     */
    private function themeTokens(): array
    {
        $themes = $this->plugin->providedThemes();
        /** @var array<string, string> $tokens */
        $tokens = $themes[0]['tokens'];

        return $tokens;
    }

    #[Test]
    public function testImplementsLifecycleInterface(): void
    {
        $this->assertInstanceOf(\Phlix\Shared\Plugin\LifecycleInterface::class, $this->plugin);
    }

    #[Test]
    public function testImplementsThemeSourceInterface(): void
    {
        $this->assertInstanceOf(\Phlix\Theming\ThemeSourceInterface::class, $this->plugin);
    }

    #[Test]
    public function testReturnsCorrectSourceName(): void
    {
        $this->assertSame('void-bloom', $this->plugin->themeSourceName());
    }

    #[Test]
    public function testProvidesAtLeastOneTheme(): void
    {
        $themes = $this->plugin->providedThemes();
        $this->assertNotEmpty($themes, 'Plugin must provide at least one theme');
    }

    #[Test]
    public function testProvidesVoidBloomThemeWithCorrectId(): void
    {
        $themes = $this->plugin->providedThemes();
        $theme = $themes[0];

        $this->assertSame('void-bloom', $theme['id']);
        $this->assertSame('Void Bloom', $theme['name']);
        $this->assertTrue($theme['dark'], 'Theme must be marked as dark');
    }

    #[Test]
    public function testExtendsMidnightBase(): void
    {
        $themes = $this->plugin->providedThemes();
        $this->assertSame('midnight', $themes[0]['extends']);
    }

    /**
     * The five legacy `--color-*` aliases this theme ships and documents
     * (README "Legacy `--color-*` aliases"). The name deliberately drops the
     * old "required" claim: the host's pairing law (phlix-server
     * src/Theming/BuiltInThemes.php:62-66 — a theme that extends a built-in
     * and overrides one half of a pair "should set both") implies the full
     * 22-key legacy set, and this payload carries 5. The 17 orphaned halves
     * are OWNER-PARKED in fixlog/W-min161-void-bloom__report.md (adding
     * token values is owner-gated); this test pins today's shipped subset,
     * not a spec of what should ship.
     */
    #[Test]
    public function testProvidesDocumentedLegacyColorAliases(): void
    {
        $tokens = $this->themeTokens();

        $this->assertArrayHasKey('--color-bg', $tokens);
        $this->assertArrayHasKey('--color-surface', $tokens);
        $this->assertArrayHasKey('--color-text', $tokens);
        $this->assertArrayHasKey('--color-text-muted', $tokens);
        $this->assertArrayHasKey('--color-border', $tokens);
    }

    #[Test]
    public function testProvidesAccentTokens(): void
    {
        $tokens = $this->themeTokens();

        $this->assertArrayHasKey('--accent', $tokens);
        $this->assertArrayHasKey('--accent-hover', $tokens);
        $this->assertArrayHasKey('--accent-active', $tokens);
        $this->assertArrayHasKey('--accent-soft', $tokens);
        $this->assertArrayHasKey('--accent-ring', $tokens);
        $this->assertArrayHasKey('--accent-text', $tokens);
    }

    #[Test]
    public function testProvidesSurfaceTokens(): void
    {
        $tokens = $this->themeTokens();

        $this->assertArrayHasKey('--surface', $tokens);
        $this->assertArrayHasKey('--surface-2', $tokens);
        $this->assertArrayHasKey('--surface-3', $tokens);
        $this->assertArrayHasKey('--surface-glass', $tokens);
        $this->assertArrayHasKey('--surface-glass-strong', $tokens);
    }

    #[Test]
    public function testProvidesBorderTokens(): void
    {
        $tokens = $this->themeTokens();

        $this->assertArrayHasKey('--border', $tokens);
        $this->assertArrayHasKey('--border-subtle', $tokens);
        $this->assertArrayHasKey('--border-strong', $tokens);
    }

    #[Test]
    public function testProvidesAtmosphericTokens(): void
    {
        $tokens = $this->themeTokens();

        $this->assertArrayHasKey('--grain-opacity', $tokens);
        $this->assertArrayHasKey('--vignette', $tokens);
        $this->assertArrayHasKey('--ambient', $tokens);
    }

    #[Test]
    public function testReturnsNoSubscribedEvents(): void
    {
        // subscribedEvents(): array is enforced by the signature itself.
        $events = $this->plugin->subscribedEvents();
        $this->assertEmpty($events, 'Theme plugins should not subscribe to events');
    }

    #[Test]
    public function testHandlesEnableWithoutErrors(): void
    {
        $container = $this->createMock(\Psr\Container\ContainerInterface::class);

        // Should not throw — the test failing IS the assertion.
        $this->expectNotToPerformAssertions();
        $this->plugin->onEnable($container);
    }

    #[Test]
    public function testHandlesDisableWithoutErrors(): void
    {
        // Should not throw — the test failing IS the assertion.
        $this->expectNotToPerformAssertions();
        $this->plugin->onDisable();
    }

    #[Test]
    public function testConstantSourceNameIsCorrect(): void
    {
        $this->assertSame('void-bloom', VoidBloomPlugin::SOURCE_NAME);
    }

    #[Test]
    public function testAllTokenValuesMatchTheHostTokenGrammar(): void
    {
        foreach ($this->themeTokens() as $token => $value) {
            $trimmed = trim($value);

            $this->assertLessThanOrEqual(
                self::MAX_VALUE_LENGTH,
                strlen($trimmed),
                sprintf('Token %s exceeds the host validator length cap: %s', $token, $value)
            );

            $this->assertTrue(
                preg_match(self::HEX_PATTERN, $trimmed) === 1
                || preg_match(self::FUNCTION_PATTERN, $trimmed) === 1
                || preg_match(self::NUMBER_PATTERN, $trimmed) === 1
                || in_array(strtolower($trimmed), self::KEYWORDS, true),
                sprintf(
                    'Token %s value %s matches no host grammar family (hex, color function,'
                    . ' bare number, keyword) — empty strings, var()/url() indirection and any'
                    . ' other shape fail here exactly as the host would reject them',
                    $token,
                    $value
                )
            );
        }
    }
}
