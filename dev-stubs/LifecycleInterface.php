<?php

/**
 * Dev-only stub of the host plugin lifecycle contract.
 *
 * @copyright 2026 Joe Huss <detain@interserver.net>
 * @license   MIT
 */

declare(strict_types=1);

namespace Phlix\Shared\Plugin;

use Psr\Container\ContainerInterface;

/**
 * Dev-only stub of `Phlix\Shared\Plugin\LifecycleInterface`.
 *
 * The canonical definition ships in `detain/phlix-shared`
 * (`src/Plugin/LifecycleInterface.php`) and is resolved by the host
 * application's autoloader in an installed plugin. This copy exists only for
 * the case where the plugin is checked out and analysed without that package
 * present; `tests/bootstrap.php` loads it only when the real interface is
 * absent, and `phpstan.neon` introduces it through `scanDirectories` (which
 * INTRODUCES a symbol; `stubFiles` would only override one PHPStan can already
 * resolve, and is silently useless for a symbol it cannot find at all).
 *
 * The method docblocks below carry the host's text (its `@since` version
 * tags aside): this stub IS the contract inside this repo's own CI, so
 * documenting a different data structure here would let a wrong-shaped
 * implementation type-check green locally and fail against the real host
 * loader on enable.
 *
 * Keep in sync with the host definition if that contract ever changes.
 *
 * @internal Tests/analysis only — never autoloaded into production.
 */
interface LifecycleInterface
{
    /**
     * Called by the loader once when the plugin is enabled. The plugin
     * may resolve services from the container, open clients, prime
     * caches — but must not block. Throw to abort enabling; the loader
     * surfaces the throwable as a `PluginEnableException` on the host.
     *
     * @param ContainerInterface $container Host PSR-11 container.
     *
     * @return void
     */
    public function onEnable(ContainerInterface $container): void;

    /**
     * Called by the loader once when the plugin is disabled, after the
     * loader has unsubscribed every listener returned from
     * {@see subscribedEvents()}. Use it to flush queued state, close
     * clients, etc. Exceptions are caught and logged but the disable
     * still completes.
     *
     * @return void
     */
    public function onDisable(): void;

    /**
     * Return the PSR-14 listener subscriptions this plugin wants.
     *
     * Keys are event class FQCNs; values are either a string method
     * name on this instance, or a PHP callable. The loader wraps each
     * entry into a callable and subscribes it to the dispatcher.
     *
     * @return array<class-string, string|callable> Subscriptions keyed
     *         by event FQCN.
     */
    public function subscribedEvents(): array;
}
