# Security Policy

## Supported Versions

The following versions are currently supported with security updates:

| Version | Supported          |
| ------- | ------------------ |
| 2.2.x   | :white_check_mark: |
| 2.1.x   | :x:                |
| 2.0.x   | :x:                |

## Reporting a Vulnerability

If you discover a security vulnerability, please send an email to the maintainer.
All security vulnerabilities will be promptly addressed.

## Security Improvements (v2.2)

This release includes significant security enhancements:

### 1. CSRF Protection

A new `Vktote\Security\CsrfToken` class has been implemented to prevent Cross-Site Request Forgery attacks.

**Features:**
- Cryptographically secure token generation using `random_bytes(32)`
- Timing-safe comparison using `hash_equals()` to prevent timing attacks
- Automatic session management
- Easy integration with forms via `CsrfToken::input()` method

**Implementation:**
```php
// Generate hidden input for forms
$csrfInput = CsrfToken::input();

// Validate token on POST requests
if (CsrfToken::validate($_POST['csrf_token'])) {
    // Token is valid
}
```

**Files affected:**
- `app/Security/CsrfToken.php` - New file
- `app/Http/Controllers/SettingsController.php`
- `app/Http/Controllers/UserController.php`
- `app/Http/Controllers/SiteController.php`
- `public/js/group-add.js`
- `public/js/login.js`
- `view/index.twig`
- `view/settings/group-add.twig`

### 2. Path Traversal Protection

Added input validation to prevent directory traversal attacks. All user-supplied group names and file paths are now validated against a strict regex pattern: `/^[a-zA-Z0-9_-]+$/`

**Files affected:**
- `app/Settings/File/File.php` - File path validation
- `app/Settings/Group.php` - Group name validation  
- `app/Http/Controllers/SettingsController.php` - Delete operation validation

### 3. Security Headers

Added security headers in `.htaccess` to enhance browser security:

| Header | Value | Protection |
|--------|-------|------------|
| X-Content-Type-Options | nosniff | Prevents MIME type sniffing |
| X-Frame-Options | SAMEORIGIN | Prevents clickjacking |
| X-XSS-Protection | 1; mode=block | XSS filter for older browsers |

Additionally, improved access control for sensitive files:
- `.htaccess`, `.htpasswd`, `.env`, `composer.json`, `composer.lock`, `.gitignore` - Denied
- `.ini` and `.php` files in web root - Denied (except public directory)
- `robots.txt` and `favicon.

### 4. Input Sanitization

Added `sanitizeIniValue()` function inico` - Allowed PatternIni.php to properly escape user input before writing to configuration files:
- Escapes newlines and special characters
- Wraps values in quotes
- Prevents INI file injection

### 5. Removed Hardcoded Credentials

- Removed `USER_ACCESS_KEY` constant from `config.php`

### 6. PHP Requirements

- Updated minimum PHP version to **8.1** for improved type safety and modern security features
- Added `declare(strict_types=1)` to main entry points

## Best Practices

When extending this application, follow these security guidelines:

1. **Always validate user input** - Use whitelist approaches where possible
2. **Use CSRF tokens** - All state-changing POST/PUT/DELETE requests must include CSRF validation
3. **Escape output** - Use appropriate escaping functions (htmlspecialchars, etc.)
4. **Keep dependencies updated** - Regularly update Composer packages
5. **Never store credentials in code** - Use environment variables or secure config files
