# Void Bloom Theme for Phlix

A dark, atmospheric UI theme for Phlix with coral accents and deep shadows.

## Theme Tokens

The payload registers one theme — id `void-bloom`, name *Void Bloom*, `dark:
true`, extending the built-in `midnight` base — and contributes the 28 CSS
custom properties below. Each row names the actual token it ships; `tests/TokenContrastTest.php`
recomputes WCAG math from these values on every run.

### Accent family

| Token | Value | Role |
|-------|-------|------|
| `--accent` | `#ff6b6b` | Coral accent — fills, active states |
| `--accent-hover` | `#ff8787` | Accent hover step |
| `--accent-active` | `#fa5252` | Accent pressed step |
| `--accent-soft` | `rgba(255, 107, 107, 0.15)` | Translucent accent background (soft tints, selected rows) |
| `--accent-ring` | `rgba(255, 107, 107, 0.7)` | Keyboard focus ring — the ui paints `box-shadow: 0 0 0 Npx var(--accent-ring)` after `outline: none`, so this is the only desktop focus cue; 0.7 alpha keeps it ≥3:1 (WCAG 1.4.11) against every ground adjacency |
| `--accent-text` | `#ff6b6b` | **The accent hue as foreground text/icon** — per the contract (`phlix-tokens/src/css/colors.css`: the accent *as* foreground, AA ≥4.5:1 on bg/surfaces); here it is the coral itself, 6.01–7.34:1 on the surface stack. This is *not* the ink painted on accent-filled controls — that role is `--text-on-accent` |

### Background & surfaces

| Token | Value | Role |
|-------|-------|------|
| `--bg` | `#050505` | Primary background |
| `--surface` | `#0c0c0c` | Card/panel surfaces |
| `--surface-2` | `#141414` | Elevated surfaces |
| `--surface-3` | `#1e1e1e` | Highest elevation |
| `--surface-glass` | `rgba(12, 12, 12, 0.65)` | Glass panel overlay |
| `--surface-glass-strong` | `rgba(5, 5, 5, 0.85)` | Stronger glass overlay |

### Text ramp

| Token | Value | Role |
|-------|-------|------|
| `--text` | `#f5f0e8` | Primary text (warm white) |
| `--text-muted` | `#c9c2b8` | Secondary text |
| `--text-subtle` | `#9c948a` | Tertiary text — placeholders/hints, AA ≥4.5:1 on every ground (pinned) |
| `--text-faint` | `#8f877d` | Disabled/hint text — carries form placeholders and help copy, AA ≥4.5:1 on every ground (pinned) |
| `--text-on-accent` | `#050505` | Dark ink painted **on** accent-filled controls (Button, Badge, Switch knob) — the ink-on-fill role, distinct from `--accent-text` |

### Borders & atmosphere

| Token | Value | Role |
|-------|-------|------|
| `--border` | `#252220` | Default borders |
| `--border-subtle` | `#1a1918` | Subtle dividers |
| `--border-strong` | `#3d3835` | Emphasized borders |
| `--grain-opacity` | `0.035` | Film grain overlay strength |
| `--vignette` | `rgba(0, 0, 0, 0.7)` | Edge darkening |
| `--ambient` | `rgba(255, 107, 107, 0.18)` | Ambient coral glow |

### Legacy `--color-*` aliases

The five keys the built-in generation still reads, each mirroring its modern
twin one-for-one (other `--color-*` halves are not overridden here — they
inherit `midnight`):

| Token | Value | Alias of |
|-------|-------|----------|
| `--color-bg` | `#050505` | `--bg` |
| `--color-surface` | `#0c0c0c` | `--surface` |
| `--color-text` | `#f5f0e8` | `--text` |
| `--color-text-muted` | `#c9c2b8` | `--text-muted` |
| `--color-border` | `#252220` | `--border` |

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
- Extends the built-in `midnight` base: the 28 tokens above are what this
  theme overrides — everything else it inherits from `midnight` unchanged

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
