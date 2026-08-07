<?php

declare(strict_types=1);

namespace Phlix\VoidBloom;

use Phlix\Shared\Plugin\LifecycleInterface;
use Phlix\Theming\ThemeSourceInterface;
use Psr\Container\ContainerInterface;

/**
 * Void Bloom UI Theme Plugin for Phlix.
 *
 * A dark, atmospheric theme with coral accents and deep shadows.
 *
 * @copyright 2026 Joe Huss <detain@interserver.net>
 */
final class VoidBloomPlugin implements LifecycleInterface, ThemeSourceInterface
{
    /**
     * Stable identifier for this theme source.
     */
    public const SOURCE_NAME = 'void-bloom';

    /**
     * {@inheritdoc}
     */
    public function onEnable(ContainerInterface $container): void
    {
        // No-op: theme plugins require no initialization.
    }

    /**
     * {@inheritdoc}
     */
    public function onDisable(): void
    {
        // No-op: theme plugins require no cleanup.
    }

    /**
     * {@inheritdoc}
     */
    public function subscribedEvents(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function themeSourceName(): string
    {
        return self::SOURCE_NAME;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<int, array{
     *     id: string,
     *     name: string,
     *     dark: bool,
     *     extends: string,
     *     tokens: array<string, string>
     * }>
     */
    public function providedThemes(): array
    {
        return [
            [
                'id' => 'void-bloom',
                'name' => 'Void Bloom',
                'dark' => true,
                'extends' => 'midnight',
                'tokens' => [
                    '--accent' => '#ff6b6b',
                    '--accent-hover' => '#ff8787',
                    '--accent-active' => '#fa5252',
                    '--accent-soft' => 'rgba(255, 107, 107, 0.15)',
                    '--accent-ring' => 'rgba(255, 107, 107, 0.5)',
                    '--accent-text' => '#ffffff',
                    '--bg' => '#050505',
                    '--surface' => '#0c0c0c',
                    '--surface-2' => '#141414',
                    '--surface-3' => '#1e1e1e',
                    '--surface-glass' => 'rgba(12, 12, 12, 0.65)',
                    '--surface-glass-strong' => 'rgba(5, 5, 5, 0.85)',
                    '--text' => '#f5f0e8',
                    '--text-muted' => '#c9c2b8',
                    '--text-subtle' => '#9c948a',
                    '--text-faint' => '#6b665e',
                    '--text-on-accent' => '#050505',
                    '--border' => '#252220',
                    '--border-subtle' => '#1a1918',
                    '--border-strong' => '#3d3835',
                    '--grain-opacity' => '0.035',
                    '--vignette' => 'rgba(0, 0, 0, 0.7)',
                    '--ambient' => 'rgba(255, 107, 107, 0.18)',
                    '--color-bg' => '#050505',
                    '--color-surface' => '#0c0c0c',
                    '--color-text' => '#f5f0e8',
                    '--color-text-muted' => '#c9c2b8',
                    '--color-border' => '#252220',
                ],
            ],
        ];
    }
}
