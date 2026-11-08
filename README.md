# Takai

**Takai is the official demo site for K2, the popular award-winning content extension for Joomla, which JoomlaWorks designed back in 2012.**

Released as a free template after requests from the K2 community, Takai is fully responsive and uses the JoomlaWorks template parameters. It is probably the best starting point for Joomla users that are just getting to know the content management super-powers of K2.

It has off-canvas navigation, flexible grids, multiple K2 layouts, 8 preset colour variations and your own variation through colour pickers. It suits a blog, a magazine-style site or a product catalog built with K2.

## Features

- The official K2 demo template
- Mobile and tablet friendly design
- 8 built-in colour variations, plus your own
- Off-canvas navigation and multiple K2 layouts

## Links

- [Product page](https://www.joomlaworks.net/joomla-templates/free-templates/takai)
- [Live demo](https://templates.joomlaworks.net/#takai)
- [Template documentation](https://www.joomlaworks.net/support/templates)
- [Installation, content & customization guides](https://www.joomlaworks.net/support/templates/general-resources)

## Requirements

- Joomla 3.9 or newer, including [Joomla 3.x UTD](https://github.com/joomlaworks/joomla-3.x)
- PHP 7.1 or newer (tested up to PHP 8.5)
- K2 for the K2 layouts

## License

Free template. See the [Terms of Service](https://www.joomlaworks.net/about/tos).

## Third-party code

Third-party code bundled with the template (versions as shipped; upstream status as of November 2026). Everything else is JoomlaWorks code.

### Front-end

| Library | Version | Location | License | Upstream |
|---|---|---|---|---|
| jQuery Tools (tabs) | 1.2.7 | `js/behaviour.js` | Public domain | Abandoned (2012) |
| normalize.css | 2.1.1 / 2.1.2 | `css/template.css` / `css/component.css` | MIT | Latest 8.0.1 |
| ZURB Foundation grid (CSS) | 4.x | `css/template.css`, `css/component.css` | MIT | Latest 6.9 |
| Entypo icons via Fontello | — | `font/fontello` | SIL OFL 1.1 | Fontello set |

### Template settings (backend)

| Library | Version | Location | License | Upstream |
|---|---|---|---|---|
| jQuery MiniColors | ~2.0 | `includes/elements/assets/js/behaviour.js` | MIT | Latest 2.3.6 |
| jQuery Swipebox | early 1.x | `includes/elements/assets/js/behaviour.js` | MIT | Latest 1.4.6, barely maintained |
| jQuery Tools (tabs) | 1.2.7 | `includes/elements/assets/js/behaviour.js` | Public domain | Abandoned (2012) |
| Google WebFont Loader | 1.x (Google CDN) | `includes/elements/nubase.php`, `includes/variations.php` | Apache-2.0 | Latest 1.6.28, unmaintained |
| Ace editor | CDN build | `includes/elements/nutextarea.php` | BSD-3-Clause | Actively maintained |

## Changelog

### Unreleased

Modernisation:

- **No MooTools needed any more:** K2 popups use K2's own modal (`data-k2-modal`), layouts no longer load MooTools or its tooltips, nuContent image popups use Joomla's modal behaviour without evaluated options (works with a strict Content Security Policy), and the template settings image field is plain JavaScript
- Removed code for Joomla versions before 3 and the "jQuery version" template parameter

### v2.0 - November 8th, 2026

- **Requirements:** Joomla 3.9 or newer (including Joomla 3.x UTD) and PHP 7.1 up to PHP 8.5
- **PHP 8 compatibility:** `count()` calls on values that may be empty (e.g. K2 tags, extra fields, attachments) replaced with `empty()` checks, so they no longer throw fatal errors on PHP 8; template parameters that are unset (e.g. on a fresh install) no longer pass `null` to string functions; the Google Fonts list is handled safely when its cache is missing or incomplete
- Tested on PHP 8.5 and PHP 7.4 by rendering the main Joomla views (home, featured, article, print view, category blog & list, archive, search, login, error page) and K2 views (item, print view, category, tag, user, search, date archive) for every K2 sub-template set: no PHP errors, warnings, notices or deprecations
- All PHP code formatted to the PSR-12 coding standard and checked for syntax errors on PHP 5.6, 7.4 and 8.1 to 8.5
- **Internet Explorer support removed:** conditional comments and IE-only `<html>` classes, the `X-UA-Compatible` and `imagetoolbar` meta tags, the html5shiv loader, IE CSS hacks (`*prop`, `_prop`, `filter: progid:...`, `-ms-` properties, `zoom: 1`, `.lt-ie9`/`.isIE*` rules) and IE-only image filters in inline styles
- **Vendor prefixes removed** where all browsers support the standard property (`-moz-`, `-o-`, `-ms-` and most `-webkit-` declarations, prefixed gradients and keyframes); legacy gradients converted to the standard syntax; `::-webkit-input-placeholder` & co. replaced by `::placeholder`
- CSS syntax errors and invalid declarations fixed (see below); empty rule sets and the obsolete `speak` property removed; stylesheets formatted one rule per line
- Images optimized losslessly (jpegoptim & optipng)
- Added the standard `mobile-web-app-capable` meta tag next to Apple's (Chrome deprecates the Apple-only one)
- Template manifest: Joomla 3.9 minimum, new update server, version 2.0
- Tested on the real demo sites (60 pages each, Joomla 3.x UTD 3.18) on PHP 7.4 and 8.5, before and after the update
- **PHP 8 fatal errors fixed:** Joomla tag pages (the `id[]` request array broke the `<body>` class), error pages rendered after a failed page ("Cannot redeclare function nuText()"), Joomla category list layouts (`$this->item->params` in a list view) and the K2 authors module (`count()` on an undefined list)
- K2 search module: removed the `maxlength`/`size` attributes whose values K2 no longer provides
- K2 layouts and modules no longer throw warnings for authors without a K2 profile, user pages without a description or undefined layout variables
- `JFilterOutput::cleanText()` now gets a variable (it takes its argument by reference)

Fixes specific to Takai:

- **Modernizr removed:** the bundled Modernizr build (which included html5shiv and the yepnope loader) is replaced by a tiny built-in equivalent; every feature it tested is supported by all current browsers, and it keeps the same `<html>` classes and `Modernizr` properties so existing CSS and scripts keep working
- **PHP 8 fatal error fixed:** the error page (e.g. 404) itself crashed, because it loaded the full page helper instead of the error helper
- K2 user pages no longer throw warnings for item ratings
- Removed reference assignments of function results (`$user = &JFactory::getUser()`)
- CSS: `box-shadow: 0` (invalid) is now `box-shadow: none`; old gradient syntax converted
