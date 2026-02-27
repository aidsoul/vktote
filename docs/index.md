# VKTote Documentation

<p align="center">
  <img src="https://img.shields.io/github/v/release/aidsoul/vktote" alt="Version">
  <img src="https://img.shields.io/badge/PHP-8.1%2B-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

VKTote is an automatic posting tool that transfers posts from VK groups to Telegram channels. This documentation will help you set up, configure, and use the application.

## Features

- 📤 **Automatic Posting** - Automatically fetch and forward VK group posts to Telegram
- 👥 **Multiple Groups** - Support for managing multiple VK group profiles
- 🎛️ **Web Control Panel** - User-friendly interface for group management
- 🔗 **Rich Media Support** - Handles photos, videos, links, and text posts
- 🌐 **API Access** - RESTful API for programmatic access
- 🔒 **Security** - CSRF protection and secure authentication

## Quick Start

New to VKTote? Get started in minutes:

1. [Installation Guide](getting-started/installation.md) - Set up the application
2. [Configuration Guide](getting-started/configuration.md) - Configure your first group
3. [Basic Usage](usage/basic-usage.md) - Learn the basics

## Table of Contents

### Getting Started
- [Installation](getting-started/installation.md) - System requirements and setup
- [Configuration](getting-started/configuration.md) - Configuring VK and Telegram

### Usage
- [Basic Usage](usage/basic-usage.md) - Core functionality
- [Control Panel](usage/control-panel.md) - Web interface guide

### API Reference
- [API Overview](api/overview.md) - Introduction to the API
- [Endpoints](api/endpoints.md) - Available API endpoints

### Development
- [Project Structure](architecture/structure.md) - Code organization
- [Troubleshooting](troubleshooting.md) - Common issues and solutions

## System Requirements

| Requirement | Version |
|------------|---------|
| PHP | 8.1 or higher |
| MySQL | 5.7+ |
| Apache/Nginx | Latest |
| Composer | 2.0+ |

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
