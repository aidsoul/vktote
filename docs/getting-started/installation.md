# Installation Guide

This guide will help you install VKTote on your server.

## System Requirements

Before installing VKTote, ensure your server meets these requirements:

| Requirement | Minimum Version |
|------------|-----------------|
| PHP | 8.1 or higher |
| MySQL | 5.7+ |
| Web Server | Apache2 or Nginx |
| Composer | 2.0+ |

### Required PHP Extensions

- `pdo` - Database connectivity
- `pdo_mysql` - MySQL driver
- `curl` - HTTP requests
- `json` - JSON processing
- `mbstring` - Multibyte string support

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/aidsoul/vktote
cd vktote
```

Or use Composer to create the project:

```bash
composer create-project aidsoul/vktote
```

### 2. Install Dependencies

Install all required PHP libraries using Composer:

```bash
composer install
```

### 3. Configure Database

#### Create a MySQL Database

Log in to MySQL and create a new database:

```sql
CREATE DATABASE vk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Import Database Schema

Import the database structure from the provided SQL file:

```bash
mysql -u root -p vk < db.sql
```

Or import via phpMyAdmin:
1. Open phpMyAdmin
2. Select your database
3. Go to "Import" tab
4. Choose `db.sql` file
5. Click "Import"

### 4. Configure Application

Edit the [`config.php`](../../config.php) file to set your database credentials:

```php
<?php
// Database Configuration
define("DB_COMMON", false);
define("DB_HOST", "localhost");
define("DB_NAME", "vk");
define("DB_USER", "root");
define("DB_PASS", "your_password");

// Group Configuration
define("PATH_GROUP_FOLDER", "groups");
define("GROUP_CONFIG", "config.ini");
define("GROUP_START", "start.php");

// User Configuration
define("USER_CONFIG", "user.ini");

// Settings
define("SETTINGS_PATTERN", "Pattern");
```

### 5. Set File Permissions

Ensure the following directories are writable:

```bash
chmod -R 755 groups/
chmod -R 755 public/
```

### 6. Configure Web Server

#### Apache (.htaccess)

The project includes an `.htaccess` file for Apache. Ensure `mod_rewrite` is enabled:

```bash
a2enmod rewrite
```

#### Nginx Configuration

If using Nginx, add this to your server block:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

### 7. Verify Installation

1. Start your web server
2. Open your browser and navigate to your domain
3. You should see the VKTote login page
4. Log in and create your first group profile

## Installation Troubleshooting

### Common Issues

#### "Composer install failed"

- Ensure PHP 8.1+ is installed: `php -v`
- Try: `composer install --no-dev`

#### "Database connection failed"

- Verify MySQL credentials in `config.php`
- Check MySQL service is running: `systemctl status mysql`

#### "Permission denied" errors

- Check file permissions on `groups/` and `public/`
- Run: `chmod -R 775 groups/ public/`

## Next Steps

After installation, proceed to:
- [Configuration Guide](configuration.md) - Set up your first group
- [Control Panel Guide](../usage/control-panel.md) - Learn to use the web interface
