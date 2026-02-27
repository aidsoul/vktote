<?php

namespace Vktote\Security;

/**
 * CSRF Token Generator and Validator
 */
class CsrfToken
{
    private const TOKEN_NAME = 'csrf_token';
    private const TOKEN_LENGTH = 32;

    /**
     * Ensure session is started
     */
    private static function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Generate and store CSRF token in session
     *
     * @return string
     */
    public static function generate(): string
    {
        self::ensureSession();
        
        $token = bin2hex(random_bytes(self::TOKEN_LENGTH));
        $_SESSION[self::TOKEN_NAME] = $token;
        
        return $token;
    }

    /**
     * Get current CSRF token from session
     *
     * @return string|null
     */
    public static function get(): ?string
    {
        self::ensureSession();
        
        return $_SESSION[self::TOKEN_NAME] ?? null;
    }

    /**
     * Validate CSRF token
     *
     * @param string|null $token
     * @return bool
     */
    public static function validate(?string $token): bool
    {
        self::ensureSession();
        
        if ($token === null || !isset($_SESSION[self::TOKEN_NAME])) {
            return false;
        }
        
        return hash_equals($_SESSION[self::TOKEN_NAME], $token);
    }

    /**
     * Generate hidden input field HTML
     * 
     * Uses existing token if available to prevent issues with multiple tabs
     *
     * @return string
     */
    public static function input(): string
    {
        // Use existing token if available, otherwise generate new one
        $token = self::get();
        if ($token === null) {
            $token = self::generate();
        }
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }
}
