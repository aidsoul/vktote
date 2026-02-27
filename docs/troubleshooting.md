# Troubleshooting Guide

This guide helps resolve common issues with VKTote.

## Installation Issues

### Composer Install Fails

**Problem**: `composer install` fails with errors

**Solutions**:
- Ensure PHP 8.1+ is installed: `php -v`
- Update Composer: `composer self-update`
- Try: `composer install --no-dev`

### Database Connection Failed

**Problem**: Cannot connect to MySQL database

**Solutions**:
1. Check MySQL is running: `systemctl status mysql`
2. Verify credentials in `config.php`
3. Test connection:
   ```php
   <?php
   $pdo = new PDO('mysql:host=localhost;dbname=vk', 'root', 'password');
   ```
4. Check user permissions: `GRANT ALL ON vk.* TO 'root'@'localhost';`

### Permission Denied Errors

**Problem**: File/folder permission errors

**Solutions**:
```bash
# Set correct permissions
chmod -R 755 groups/
chmod -R 755 public/
chmod -R 775 storage/  # if exists

# For Apache/Nginx
chown -R www-data:www-data /var/www/html/vktote
```

## VK Integration Issues

### Invalid VK Token

**Problem**: VK API returns "Invalid token" error

**Solutions**:
1. Token may have expired - get a new token
2. Check token has required permissions: `wall`, `groups`
3. Verify the token matches the correct VK app

### Group Not Found

**Problem**: Cannot find VK group

**Solutions**:
1. Verify group ID/screen name in `config.ini`
2. Ensure the VK app has access to the group
3. Check if group is public/closed - may need additional permissions

### Rate Limit Exceeded

**Problem**: VK API returns rate limit error

**Solutions**:
1. Increase cron interval
2. Reduce `count` parameter in config
3. Implement token rotation

## Telegram Integration Issues

### Bot Not Found

**Problem**: Telegram bot cannot be reached

**Solutions**:
1. Verify bot token is correct
2. Check bot username in config
3. Test with BotFather: send `/mybots`

### Chat Not Found

**Problem**: Messages not being sent to channel

**Solutions**:
1. Verify chat ID is correct (starts with `-100` for channels)
2. Add bot to channel as admin
3. Bot must be admin to post in channels

### Messages Not Being Sent

**Problem**: Bot runs but no messages appear

**Solutions**:
1. Check bot has proper permissions in channel
2. Verify chat ID format: `-1001234567890`
3. Check bot is not blocked

## Web Interface Issues

### 404 Page Not Found

**Problem**: Routes return 404

**Solutions**:
1. Enable mod_rewrite (Apache): `a2enmod rewrite`
2. Check `.htaccess` is being read
3. For Nginx: configure proper rewrite rules

### Session Expired

**Problem**: Keep getting logged out

**Solutions**:
1. Clear browser cookies
2. Check PHP session configuration
3. Verify session directory is writable

### Cannot Create Profile

**Problem**: Group profile creation fails

**Solutions**:
1. Check `groups/` folder is writable
2. Verify `config.ini` syntax is correct
3. Check error logs

## Cron Job Issues

### Cron Not Running

**Problem**: Tasks not executing automatically

**Solutions**:
1. Check cron is installed: `which crontab`
2. Verify cron service is running
3. Check crontab: `crontab -l`
4. Check system logs: `/var/log/syslog`

### No Output from Cron

**Problem**: Cron runs but no output

**Solutions**:
1. Use absolute paths: `php /full/path/to/start.php`
2. Add logging: `php start.php group >> /var/log/vktote.log 2>&1`
3. Check PHP path: `which php`

### Script Runs Manually but Not in Cron

**Problem**: Works in terminal but not cron

**Solutions**:
1. Use full paths in cron commands
2. Set working directory in cron
3. Check environment differences

## Common Error Messages

### "The argument(Group name) is not set"

**Cause**: No group name provided to `start.php`

**Fix**: Provide group name: `php start.php mygroup`

### "Config folder not found"

**Cause**: Group folder doesn't exist

**Fix**: Create folder in `groups/` directory

### "404 Page Not Found"

**Cause**: Route not matched

**Fix**: Check URL and .htaccess configuration

### "Access denied"

**Cause**: Not logged in or wrong password

**Fix**: Log in with correct credentials

## Debugging Tips

### Enable PHP Error Reporting

Add to top of PHP files:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### Check Logs

- PHP error log: `/var/log/php_errors.log`
- Apache error log: `/var/log/apache2/error.log`
- Nginx error log: `/var/log/nginx/error.log`
- Cron log: `/var/log/syslog`

### Test Bot Manually

Run bot directly to see errors:
```bash
php -d display_errors start.php mygroup
```

## Getting Help

If you can't find a solution:
1. Check [GitHub Issues](https://github.com/aidsoul/vktote/issues)
2. Search existing discussions
3. Create a new issue with:
   - PHP version
   - Error message
   - Steps to reproduce
   - Configuration (remove sensitive data)
