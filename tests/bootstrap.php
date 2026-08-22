<?php

/**
 * PHPUnit bootstrap file for phlix-plugin-void-bloom-theme.
 *
 * Sets up the autoloader and any required stubs for testing.
 */

declare(strict_types=1);

// Try to use Composer's autoloader if available
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
} else {
    // Fallback: register a simple PSR-4 autoloader for the plugin source
    spl_autoload_register(function (string $class): void {
        $prefix = 'Phlix\\VoidBloom\\';
        $baseDir = __DIR__ . '/../src/';

        if (str_starts_with($class, $prefix)) {
            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        }

        // Also handle test classes
        $testPrefix = 'Phlix\\VoidBloom\\Tests\\';
        if (str_starts_with($class, $testPrefix)) {
            $relativeClass = substr($class, strlen($testPrefix));
            $file = __DIR__ . '/phpunit/unit/' . str_replace('\\', '/', $relativeClass) . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        }
    });
}

// Load dev stubs if they exist and the real interfaces aren't available
$stubsDir = __DIR__ . '/../dev-stubs/';
if (is_dir($stubsDir)) {
    // Make stubs available as fallbacks
    spl_autoload_register(function (string $class) use ($stubsDir): void {
        $stubFiles = [
            'Phlix\\Shared\\Plugin\\LifecycleInterface' => 'LifecycleInterface.php',
            'Phlix\\Theming\\ThemeSourceInterface' => 'ThemeSourceInterface.php',
        ];

        foreach ($stubFiles as $fqcn => $filename) {
            if ($class === $fqcn) {
                $path = $stubsDir . $filename;
                if (file_exists($path)) {
                    require_once $path;
                }
            }
        }
    }, true, true);
}

// Set environment for testing
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'testing';
