# Control Panel Guide

VKTote includes a web-based control panel for easy management of your group profiles.

## Accessing the Control Panel

| Page | URL |
|------|-----|
| Login | `https://yourdomain.com/` |
| Settings | `https://yourdomain.com/settings` |

## First Login

On first access, you'll be prompted to create an admin password:

1. Navigate to your domain
2. Enter your desired password
3. Confirm the password
4. Click "Create"

**Important**: Remember your password - there's no recovery option!

## Dashboard Overview

After logging in, you can:
- View existing group profiles
- Add new group profiles
- Delete existing profiles
- Configure settings

## Creating a Group Profile

### Using the Control Panel

1. Go to `https://yourdomain.com/settings`
2. Click "Create a settings profile"
3. Fill in the required fields:

#### VK Settings
| Field | Description |
|-------|-------------|
| Group Token | VK API access token |
| Group ID | VK group ID or screen name |
| Post Count | Number of posts to fetch |

#### Telegram Settings
| Field | Description |
|-------|-------------|
| Bot API Key | Telegram bot token |
| Bot Name | Your bot's username |
| Chat ID | Target channel ID |

#### General Settings
| Field | Description |
|-------|-------------|
| Language | Bot language (eng/rus) |

4. Click "Save"

### Manual Creation

You can also create profiles manually:

1. Create folder: `groups/mygroup/`
2. Create config file: `groups/mygroup/config.ini`
3. Add configuration as described in [Configuration Guide](../getting-started/configuration.md)

## Deleting a Group Profile

1. Go to `https://yourdomain.com/settings`
2. Find the group you want to delete
3. Click the delete button
4. Confirm deletion

## User Authentication

### Login

1. Enter your password on the main page
2. Click "Log in"

### Logout

Click "Exit" button to log out of the control panel.

## Security Features

### CSRF Protection
All forms include CSRF tokens to prevent cross-site attacks.

### Session Security
- Sessions are started securely
- Session data is protected

### Password Storage
Passwords are stored securely using PHP's password hashing.

## Interface Languages

VKTote supports:
- English (`eng`)
- Russian (`rus`)

Set the language in the control panel or in the `config.ini` file:

```ini
[Bot]
lang="rus"
```

## Troubleshooting

### "Session expired"
- Clear browser cookies
- Log in again

### "Access denied"
- Check your password
- Ensure you're logged in

### "Profile not found"
- Verify the group folder exists in `groups/`
- Check folder permissions

## API Access

For programmatic access, use the REST API:

- Base URL: `https://yourdomain.com/api/`
- See [API Overview](../api/overview.md) for details
