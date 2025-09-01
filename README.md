# Netmatters Homepage

## Overview

This project is a modernised refactor of the original Netmatters homepage codebase. The update focuses on:

- Using Sass **@use** / **@forward** module system (no `@import`).
- Centralised semantic color variables written in **HSL** for easier theming and accessibility.
- Reorganised SCSS into a clearer app structure with `globals`, `layout`, `util` folders.
- Leaving `dist/` (compiled assets) untouched so you can control when to rebuild.

> Note: This README was added as part of a professional update to my first attempt at bulding. It documents the new structure and how to build.

---

## Project structure (important paths)
```
sample-project/
├─ dist/ # Compiled CSS and other build artifacts (untouched)
├─ index.html
├─ app/
│ └─ scss/
│ ├─ style.scss # Entry point (uses @use to load modules)
│ ├─ globals/
│ │ ├─ \_colors.scss # Semantic CSS custom properties (HSL)
│ │ ├─ \_typography.scss
│ │ ├─ \_boilerplate.scss
│ │ ├─ \_variables.scss # Non-colour tokens (spacing, z-index, transitions)
│ │ └─ \_index.scss # @forward all globals
│ ├─ layout/
│ │ ├─ \_header.scss
│ │ ├─ \_footer.scss
│ │ ├─ ... # other layout partials
│ │ └─ \_index.scss
│ └─ util/
│ ├─ \_utilities.scss
│ ├─ \_mobile-fixes.scss
│ └─ \_index.scss
├─ img/
└─ fonts/
```
## Colours & tokens

- All colours are defined as CSS custom properties (HSL) in `app/scss/globals/_colors.scss` using semantic names such as:
  - `--background-color`
  - `--text-color`
  - `--primary-color`, `--secondary-color`, `--accent-color`
  - `--muted-*`, `--neutral-*`
- Each HSL variable is commented with the original hex value for reference.
- Non-colour design tokens (spacing, z-index, transition durations) are in `app/scss/globals/_variables.scss` as SCSS variables — these are intentionally kept as SCSS tokens so they can be used in calculation and mixins.

## Sass module usage

- The `style.scss` entry uses `@use` to bring globals and the forwarded `_index.scss` files from layout/util. This avoids polluting the global namespace and follows modern best practices.

## How colours were migrated

- Hex colours found in the original SCSS were converted to HSL and mapped to readible names.
- Source SCSS partials in `app/scss/layout` and `app/scss/util` were updated to use `var(--semantic-name)` where possible. If no semantic mapping was available, a fallback `var(--color-<hex>)` pattern was used.

## License & contact

This project is dedicated to the public domain under The Unlicense. It is free for anyone to use, modify, distribute, and sublicense for any purpose without restriction.

Full Unlicense text is included in the LICENSE file at the project root.

---
