<?php

declare(strict_types=1);

namespace Phlix\Shared\Plugin;

use Psr\Container\ContainerInterface;

/**
 * LifecycleInterface for Phlix plugins.
 *
 * Stub for standalone CI when the host contract is unavailable.
 */
interface LifecycleInterface
{
    /**
     * Called when the plugin is enabled.
     */
    public function onEnable(ContainerInterface $container): void;

    /**
     * Called when the plugin is disabled.
     */
    public function onDisable(): void;

    /**
     * Returns the events this plugin subscribes to.
     *
     * @return array<string, array<int, array{0: string, 1: int}>>
     */
    public function subscribedEvents(): array;
}
