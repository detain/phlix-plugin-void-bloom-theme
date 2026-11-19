---
description: PHPUnit, PHPStan and PHPCS conventions for this Phlix theme plugin
globs: ["src/**/*.php", "tests/**/*.php", "dev-stubs/**/*.php"]
alwaysApply: false
---

# Testing & Static Analysis

- Run the suite with `vendor/bin/phpunit --colors=always`; `phpunit.xml` sets `bootstrap="tests/bootstrap.php"` and discovers `*Test.php` under `./tests`.
- Tests live in `tests/` under the `Phlix\VoidBloom\Tests\` namespace (PSR-4 `autoload-dev`) and use PHPUnit 10 attributes — `#[CoversClass]` on the class, `#[Test]` on each method.
- The host contracts `Phlix\Shared\Plugin\LifecycleInterface` and `Phlix\Theming\ThemeSourceInterface` are not installable standalone; the tracked stubs in `dev-stubs/` stand in for them and are autoloaded by `tests/bootstrap.php`. Keep the stub signatures in sync with `src/VoidBloomPlugin.php`.
- Run PHPStan as `composer phpstan` (`vendor/bin/phpstan analyse -c phpstan.neon`), never `phpstan analyse src` — otherwise `scanDirectories: dev-stubs` is skipped and level 9 fails on the missing interfaces.
- Run PHPCS as `composer phpcs` (`vendor/bin/phpcs --standard=phpcs.xml`), never `phpcs src` — otherwise `tests/` and `dev-stubs/` go unchecked. The standard is `PSR12`.
- `dev-stubs/` is excluded from coverage in `phpunit.xml`; coverage is collected from `./src` only and uploaded to Codacy from the PHP 8.3 leg of `.github/workflows/test.yml`.
