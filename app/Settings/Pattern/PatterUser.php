<?php 
/**
 * Generate user.ini content
 * @param string $passwordHash The bcrypt password hash
 * @return string
 */
function patternUser(string $passwordHash = ''): string {
    return "[User]\npassword = \"".$passwordHash."\"";
}
