# Void Bloom Theme for Phlix

A dark, atmospheric UI theme for Phlix with coral accents and deep shadows.

## Theme Tokens

| Token | Value | Description |
|-------|-------|-------------|
| **Theme ID** | `void-bloom` | Unique identifier |
| **Extends** | `midnight` | Parent theme |
| **Accent** | `#ff6b6b` | Coral accent color |
| **Background** | `#050505` | Primary background |
| **Surface** | `#0c0c0c` | Card/panel surfaces |
| **Surface 2** | `#141414` | Elevated surfaces |
| **Surface 3** | `#1e1e1e` | Highest elevation |
| **Text** | `#f5f0e8` | Primary text (warm white) |
| **Text Muted** | `#c9c2b8` | Secondary text |
| **Text Subtle** | `#9c948a` | Tertiary text |
| **Text Faint** | `#8f877d` | Disabled/hint text |
| **Border** | `#252220` | Default borders |
| **Border Subtle** | `#1a1918` | Subtle dividers |
| **Border Strong** | `#3d3835` | Emphasized borders |
| **Ambient** | `rgba(255, 107, 107, 0.18)` | Accent glow effect |
| **Vignette** | `rgba(0, 0, 0, 0.7)` | Edge darkening |
| **Grain Opacity** | `0.035` | Film grain overlay |

## Color Palette

```
Coral Accent:   #ff6b6b  ████
Coral Hover:    #ff8787  ████
Coral Active:   #fa5252  ████

Background:     #050505  ████████
Surface:        #0c0c0c  ████████
Surface 2:      #141414  ████████
Surface 3:      #1e1e1e  ████████

Text:           #f5f0e8  ████████
Text Muted:     #c9c2b8  ████████
Text Subtle:    #9c948a  ████████
Text Faint:     #8f877d  ████████
```

## Features

- Dark atmospheric design with warm coral accents
- Deep shadows and layered surface system
- Ambient coral glow effects
- Film grain texture overlay
- Vignette edge darkening
- Seamless extension of the midnight base theme

## Installation

### The supported route: the plugin catalog

The Phlix server installs plugins from a **catalog** (`plugins.json`). A catalog
entry pins an exact commit (`ref`) and the sha256 of that commit's tarball
(`artifactSha256`), and the server verifies those bytes before it extracts
anything. Without a pin, `PluginLoader::install()` refuses outright — that is a
deliberate default-deny, not a bug to work around.

**Admin UI** — *Admin → Plugins* (`/app/admin/plugins`), find **Void Bloom
Theme**, press **Install**, then flip its switch to **enable** it.

**CLI** — from the server root, pass the **repository URL**, not the plugin
name (the URL is what gets rewritten to the pinned tarball):

```bash
php bin/phlix plugin:install https://github.com/detain/phlix-plugin-void-bloom-theme
php bin/phlix plugin:enable  phlix-plugin-void-bloom-theme
```

While iterating on a local fork (no catalog entry yet), build an archive and
install it over `file://`, which is exempt from the pin requirement because the
bytes are already yours:

```bash
tar --exclude=vendor --exclude=.git -czf /tmp/void-bloom.tar.gz phlix-plugin-void-bloom-theme/
php bin/phlix plugin:install file:///tmp/void-bloom.tar.gz
php bin/phlix plugin:enable  phlix-plugin-void-bloom-theme
```

### What does **not** work

`composer require detain/phlix-plugin-void-bloom-theme` into the server, or
cloning this repository into the plugins directory, does not register anything —
the plugin loader installs catalog-pinned archives or local tarballs, never an
ambient vendor checkout or a bare directory.

### Install, enable, and selection are three different acts

Installing downloads and stages the plugin. **Enabling** it is what registers
the theme: `PluginLoader::enable()` finds the `ThemeSourceInterface` on the
entry class and contributes the `void-bloom` theme id. Choosing the theme is a
**per-user preference**, not an admin action — each user picks *Void Bloom*
under **Settings → Appearance**. None of the three steps implies the next.

## Requirements

- PHP 8.3+
- Phlix 0.44.0+

## Development

Install dependencies:

```bash
composer install
```

Run the test suite (`phpunit.xml` boots `tests/bootstrap.php`):

```bash
vendor/bin/phpunit --colors=always
```

Run static analysis and coding standard checks:

```bash
composer phpstan
composer phpcs
```

`phpstan.neon` scans `dev-stubs/`, which stubs the host-only `Phlix\Shared\Plugin\LifecycleInterface` and `Phlix\Theming\ThemeSourceInterface` contracts, and `phpcs.xml` applies `PSR12` to `src/`, `tests/` and `dev-stubs/`. `.github/workflows/test.yml` runs all three on PHP 8.3 and 8.4.

## License

MIT License - see LICENSE file for details.
