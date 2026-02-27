# VKTote

<a href="https://github.com/aidsoul/vktote/releases/latest" title="GitHub release">
<img src="https://img.shields.io/github/v/release/aidsoul/vktote" alt="Version">
</a>
<a href="https://github.com/aidsoul/vktote/blob/main/LICENSE" title="License">
<img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</a>
<a href="#" title="PHP Version">
<img src="https://img.shields.io/badge/PHP-8.1%2B-blue" alt="PHP Version">
</a>

VKTote is an automatic posting tool that transfers posts from VK groups to Telegram channels.

## Features

- 📤 **Automatic Posting** - Automatically fetch and forward VK group posts to Telegram
- 👥 **Multiple Groups** - Support for managing multiple VK group profiles
- 🎛️ **Web Control Panel** - User-friendly interface for group management
- 🔗 **Rich Media Support** - Handles photos, videos, links, and text posts
- 🌐 **API Access** - RESTful API for programmatic access
- 🔒 **Security** - CSRF protection and secure authentication

## Quick Start

New to VKTote? Get started in minutes:

1. [Installation Guide](docs/getting-started/installation.md) - Set up the application
2. [Configuration Guide](docs/getting-started/configuration.md) - Configure your first group
3. [Basic Usage](docs/usage/basic-usage.md) - Learn the basics

## Table of Contents

### Getting Started
- [Installation](docs/getting-started/installation.md) - System requirements and setup
- [Configuration](docs/getting-started/configuration.md) - Configuring VK and Telegram

### Usage
- [Basic Usage](docs/usage/basic-usage.md) - Core functionality
- [Control Panel](docs/usage/control-panel.md) - Web interface guide

### API Reference
- [API Overview](docs/api/overview.md) - Introduction to the API
- [Endpoints](docs/api/endpoints.md) - Available API endpoints

### Development
- [Project Structure](docs/architecture/structure.md) - Code organization
- [Troubleshooting](docs/troubleshooting.md) - Common issues and solutions

## System Requirements

| Requirement | Version |
|------------|---------|
| PHP | 8.1 or higher |
| MySQL | 5.7+ |
| Apache/Nginx | Latest |
| Composer | 2.0+ |

## Installation

To install, use the command: `git clone https://github.com/aidsoul/vktote`.
Download the necessary libraries using the command: `composer install`.

Or use command `composer create-project aidsoul/vktote`.

### Import Database

Import the database file: `db.sql`.

## Configuration

All files for working with groups are located in the "groups" folder.

> In the "groups" folder, folders with the files listed below are added. All these files are needed for work. Come up with a name for the folder yourself.

The following example is a true profile group creation:
```
groups
[test]=>[config.ini]
[test1]=>[config.ini]
[test...]=>[config.ini]
```

> If necessary, you can change the folder and the name of the files in the configuration file "**config.php**".

Configuration file "**config.ini**" should look like this:
```ini
[Db]
host="localhost"
dbName="vk"
user="root"
pass=""
[Vk]
token  ="Your token"
idGroup="Group id or name"
count="Number of posts to capture"
[Telegram]
botApiKey="Bot API Key"
botName="Bot name"
chatId="Chat Id for send post"
[Bot]
lang = "eng"
```

If there is a need to use a different database for each profile of the group you need to change the constant "DB_COMMON" in config.php by setting the value to "true". You should also add: DB_HOST, DB_NAME, DB_USER, DB_PASS.

The following bot languages are available: English (eng) and Russian (rus).

## Control Panel

For the convenience of creating group profiles, use the control panel.

Use "**localhost**" to log in to the control panel.
Click on the log in button.
The first time you login, a password will be created. You need to remember the password, it will be used to access the control panel.
Go to settings "**localhost/settings**" and create a new group profile by clicking on the "Create a settings profile" button.

## Task Scheduler

Use crontab on your server or another task scheduler to get fresh posts without stopping.

### Usage example

Open and add a task to the task list: `crontab -e`.

Get fresh entries every minute: `* * * * * php start.php group_folder`.

Below is an example of running a task for the "test" group profile. Test is specified as an argument.
```
*/5 * * * * php start.php test
```

## API

All API queries start with https://domain/api/

### bot.start

Accepts a GET request with the parameter "group".

Example: https://domain/api/bot.start?group=group_name

## Technology Stack

- **Framework**: Custom PHP MVC
- **Router**: League\Route
- **Templating**: Twig
- **Database**: MySQL with PDO
- **HTTP Client**: Guzzle

## Support

- 📖 [GitHub Repository](https://github.com/aidsoul/vktote)
- 🐛 [Issue Tracker](https://github.com/aidsoul/vktote/issues)
- 📧 [Contact Author](mailto:work-aidsoul@outlook.com)

## License

This project is licensed under the [MIT License](https://github.com/aidsoul/vktote/blob/main/LICENSE).
