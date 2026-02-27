<?php
/**
 * Sanitize input for INI file
 * @param mixed $value
 * @return string
 */
function sanitizeIniValue(mixed $value): string {
    if ($value === null) {
        return '';
    }
    // Convert to string
    $value = (string)$value;
    // Escape newlines and special characters
    $value = str_replace(["\r\n", "\r", "\n"], ['\\n', '\\n', '\\n'], $value);
    // Escape special characters and wrap in quotes
    return '"' . addcslashes($value, '\\"') . '"';
}

function patternVkTel()
{
    return '[Vk]
token=' . sanitizeIniValue($_POST['token'] ?? '') . '
idGroup=' . sanitizeIniValue($_POST['idGroup'] ?? '') . '
count=' . sanitizeIniValue($_POST['count'] ?? '') . '
[Telegram]
botApiKey=' . sanitizeIniValue($_POST['botApiKey'] ?? '') . '
botName=' . sanitizeIniValue($_POST['botName'] ?? '') . '
chatId=' . sanitizeIniValue($_POST['chatId'] ?? '');
}

$pattern = '';
if (DB_COMMON) {
    $pattern = patternVkTel();
} else {
    $dbHost = sanitizeIniValue($_POST['host'] ?? '');
    $dbName = 'mysql:host=' . sanitizeIniValue($_POST['dbName'] ?? '');
    $dbUser = sanitizeIniValue($_POST['user'] ?? '');
    $dbPass = sanitizeIniValue($_POST['pass'] ?? '');
    
    $pattern = '[Db]
host=' . $dbHost . '
dbName=' . $dbName . '
user=' . $dbUser . '
pass=' . $dbPass . "\r\n" . patternVkTel() . "\r\n" .
        '[Bot]\nlang = "ENG"';
}

return $pattern;