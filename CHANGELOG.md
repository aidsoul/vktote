# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

#### Security
- **CSRF Protection** - New `Vktote\Security\CsrfToken` class with:
  - Cryptographically secure token generation using `random_bytes()`
  - Timing-safe comparison using `hash_equals()` to prevent timing attacks
  - Session management with automatic session initialization
  - Hidden input field generation for forms
  
- **Path Traversal Protection** - Added input validation using regex `/^[a-zA-Z0-9_-]+$/`:
  - `SettingsController::deleteFolderProfile()` - Group folder name validation
  - `File::set()` - File path validation  
  - `Group::create()` - Group name validation

- **Security Headers** - Added in `.htaccess`:
  - `X-Content-Type-Options: "nosniff"` - Prevents MIME type sniffing
  - `X-Frame-Options: "SAMEORIGIN"` - Prevents clickjacking attacks
  - `X-XSS-Protection: "1; mode=block"` - XSS filter for older browsers

- **Input Sanitization** - Added `sanitizeIniValue()` function in PatternIni.php:
  - Escapes newlines and special characters
  - Wraps values in quotes for INI file safety

#### Dependencies
- PHP requirement updated to `>=8.1`

### Changed

#### Security
- **Removed hardcoded access key** - Removed `USER_ACCESS_KEY` constant from `config.php`
- **Strict types** - Added `declare(strict_types=1)` to `index.php` and `start.php`

#### Performance
- **jQuery CDN** - Updated to minified version (`jquery-3.6.0.min.js`) for better performance

### Updated Files

| File | Changes |
|------|---------|
| `.htaccess` | Added security headers, improved file access rules |
| `app/Security/CsrfToken.php` | **NEW** - CSRF token generation and validation |
| `app/Http/Controllers/SettingsController.php` | CSRF validation, path traversal protection |
| `app/Http/Controllers/SiteController.php` | CSRF token passed to views |
| `app/Http/Controllers/UserController.php` | CSRF validation for login |
| `app/Settings/File/File.php` | Path validation |
| `app/Settings/Group.php` | Group name validation |
| `app/Settings/Pattern/PatterUser.php` | Code refactoring with PHPDoc |
| `app/Settings/Pattern/PatternIni.php` | Input sanitization |
| `composer.json` | PHP version requirement updated |
| `config.php` | Removed USER_ACCESS_KEY |
| `index.php` | Added strict types declaration |
| `public/js/group-add.js` | CSRF token submission |
| `public/js/login.js` | CSRF token submission |
| `start.php` | Added strict types declaration |
| `view/index.twig` | CSRF token field, jQuery CDN update |
| `view/layout/settings.twig` | jQuery CDN update |
| `view/settings/group-add.twig` | CSRF token field |

---

## [2.1] - Previous Release

See [release/v2.1](https://github.com/aidsoul/vktote/tree/release/v2.1) for previous changes.
