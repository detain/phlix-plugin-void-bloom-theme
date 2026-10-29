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
 * The method docblocks below carry the host's text: this stub IS the contract
 * inside this repo's own CI, so documenting a different data structure here
 * would let a wrong-shaped implementation type-check green locally and fail
 * against the real host loader on enable.
 *
 * Keep in sync with the host definition if that contract ever changes.
 *
 * @internal Tests/analysis only — never autoloaded into production.
 */
interface LifecycleInterface
{
    public function onEnable(ContainerInterface $container): void;

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
