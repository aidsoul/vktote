# Configuration Guide

This guide explains how to configure VKTote to work with VK groups and Telegram channels.

## Group Configuration

Each VK group you want to post from requires its own configuration folder in the `groups/` directory.

### Creating a Group Profile

1. Create a new folder inside `groups/` with your desired name (e.g., `mygroup`)
2. Create a `config.ini` file inside that folder
3. Configure the settings as described below

### Configuration File Structure

The `config.ini` file uses INI format with the following sections:

```ini
[Db]
host="localhost"
dbName="vk"
user="root"
pass=""

[Vk]
token="Your VK access token"
idGroup="group_id_or_name"
count="10"

[Telegram]
botApiKey="Bot API Key"
botName="Bot name"
chatId="Chat ID for posts"

[Bot]
lang="eng"
```

## Section Details

### [Db] - Database Configuration

| Parameter | Description | Default |
|-----------|-------------|---------|
| `host` | MySQL server hostname | `localhost` |
| `dbName` | Database name | `vk` |
| `user` | MySQL username | `root` |
| `pass` | MySQL password | (empty) |

### [Vk] - VK Configuration

| Parameter | Description | Required |
|-----------|-------------|----------|
| `token` | VK API access token | Yes |
| `idGroup` | VK group ID or screen name | Yes |
| `count` | Number of posts to fetch per run | Yes |

#### Getting VK Access Token

1. Go to [VK My Apps](https://vk.com/apps?act=manage)
2. Create a new standalone application
3. Go to "Settings" and add your redirect URI
4. Use this URL format to get the token:
```
https://oauth.vk.com/authorize?client_id=YOUR_APP_ID&display=page&scope=wall,groups&response_type=token&v=5.131
```
5. Copy the access token from the redirect URL

### [Telegram] - Telegram Configuration

| Parameter | Description | Required |
|-----------|-------------|----------|
| `botApiKey` | Telegram Bot API token | Yes |
| `botName` | Your bot's username | Yes |
| `chatId` | Target channel chat ID | Yes |

#### Getting Telegram Bot Token

1. Open [BotFather](https://t.me/BotFather) in Telegram
2. Create a new bot with `/newbot` command
3. Copy the API token provided
4. Add your bot to the target channel as an admin

#### Getting Chat ID

1. Add your bot to the channel
2. Forward a message from the channel to [@userinfobot](https://t.me/userinfobot)
3. The bot will show you the channel's chat ID
4. Or use: `@channelidbot`

### [Bot] - Bot Settings

| Parameter | Description | Options |
|-----------|-------------|---------|
| `lang` | Bot interface language | `eng`, `rus` |

## Multiple Databases

By default, all groups use the same database. To use separate databases for each group:

1. Edit `config.php` and set `DB_COMMON` to `true`:

```php
define("DB_COMMON", true);
```

2. Add database credentials to each group's `config.ini` file.

## Example Configurations

### Basic Configuration

```ini
[Db]
host="localhost"
dbName="vk"
user="root"
pass="mypassword"

[Vk]
token="vk1.a.abcdefghijk..."
idGroup="club123456789"
count="5"

[Telegram]
botApiKey="1234567890:ABCdefGHIjklMNOpqrsTUVwxyz"
botName="MyVkPosterBot"
chatId="-1001234567890"

[Bot]
lang="eng"
```

### Russian Language Configuration

```ini
[Bot]
lang="rus"
```

## Testing Your Configuration

After creating a group configuration:

1. Test via command line:
```bash
php start.php mygroup
```

2. You should see execution time and memory usage output:
```
0.05 сек. / 2.5 МБ
```

## Next Steps

- [Basic Usage](../usage/basic-usage.md) - Learn how to use the bot
- [Control Panel](../usage/control-panel.md) - Use the web interface
- [Cron Jobs](../usage/basic-usage.md#automation-with-cron) - Set up automatic posting
