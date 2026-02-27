# Basic Usage

This guide covers the core functionality of VKTote and how to use it effectively.

## Running the Bot Manually

### Command Line Usage

To fetch and post new entries from a VK group, run:

```bash
php start.php group_name
```

Where `group_name` is the folder name in your `groups/` directory.

Example:
```bash
php start.php myvkgroup
```

### Output

On successful execution, you'll see:
```
0.05 сек. / 2.5 МБ
```

This shows:
- Execution time in seconds
- Memory usage

## Automation with Cron

For automatic posting, set up a cron job on your server.

### Installing Cron

#### Debian/Ubuntu
```bash
apt update
apt install cron
systemctl enable cron
systemctl start cron
```

#### CentOS/RHEL
```bash
yum install cronie
systemctl enable crond
systemctl start crond
```

### Cron Syntax

```
* * * * * command
│ │ │ │ │
│ │ │ │ └── Day of week (0-7)
│ │ │ └──── Month (1-12)
│ │ └────── Day of month (1-31)
│ └──────── Hour (0-23)
└────────── Minute (0-59)
```

### Cron Examples

#### Run Every Minute
```bash
* * * * * php /path/to/start.php group_name
```

#### Run Every 5 Minutes
```bash
*/5 * * * * php /path/to/start.php group_name
```

#### Run Every 15 Minutes
```bash
*/15 * * * * php /path/to/start.php group_name
```

#### Run Multiple Groups
```bash
*/5 * * * * php /path/to/start.php group1
*/5 * * * * php /path/to/start.php group2
```

### Setting Up Cron

#### Using crontab
```bash
crontab -e
```

Add your cron job and save.

#### Using Direct Path
```bash
*/5 * * * * php /var/www/html/vktote/start.php mygroup >> /var/log/vktote.log 2>&1
```

## Supported Content Types

VKTote automatically handles various VK post types:

### 📝 Text Posts
Plain text posts are forwarded with formatting preserved.

### 📷 Photos
- Single photos
- Photo albums
- Photos with captions

### 🎬 Videos
- Video posts
- Video albums

### 🔗 Links
- External links with preview images
- VK internal links

### Combined Posts
Posts with multiple attachments (photos + text, video + text, etc.)

## Bot Commands

When you add the Telegram bot to a group, it responds to these commands:

### Start Bot
```
/start - Initialize the bot
```

### API Endpoint
```
GET /api/bot.start?group=group_name
```

## Web Interface

Access the control panel at:
- **Main URL**: `https://yourdomain.com/`
- **Settings**: `https://yourdomain.com/settings`

## Error Handling

### Common Errors

#### "Config folder not found"
The group folder doesn't exist in `groups/`

#### "The argument(Group name) is not set"
No group name provided in the command

#### "Token is invalid"
VK access token has expired or is incorrect

#### "Chat not found"
Telegram chat ID is incorrect or bot isn't in the channel

## Best Practices

1. **Set Appropriate Intervals**
   - Don't run too frequently (VK has rate limits)
   - 5-15 minute intervals are recommended

2. **Monitor Logs**
   - Check cron logs regularly
   - Set up error notifications

3. **Token Management**
   - VK tokens expire periodically
   - Implement token refresh logic

4. **Resource Usage**
   - Monitor memory usage
   - Adjust `count` parameter based on group activity

## Security Notes

- Keep your API tokens secure
- Don't share configuration files
- Use HTTPS for production
- Regularly rotate tokens
