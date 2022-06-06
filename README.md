<a  href="https://github.com/aidsoul/vktote/releases/latest"  title="GitHub release">
<img  src="https://img.shields.io/github/v/release/aidsoul/vktote">
</a>

# vktote

This is auto-posting from a VK group to a telegram channel.
  
## Installation
  
You need:
 - apache;
 - php 8.1;

To install, use the command: `git clone https://github.com/aidsoul/vktote`.
Download the necessary libraries using the command: `composer install`.

Or use command `composer require aidsoul/vktote`.

## Connection example
**All files for working with groups are located in the "groups" folder.**


> In the "groups" folder, folder with the files listed below are added. All these files are needed for work. Come up with a name for the folder yourself. 

The following example is a true profile group creation:

| groups | |  |
|-|--|-|-|
| test |config.ini| index.php |
| test1 |config.ini| index.php |
| test2 |config.ini| index.php |
|...|config.ini| index.php |

>If necessary, you can change the folder and the name of the files in the configuration file "**config.php**".

Configuration file "**config.ini** " should look like this:
```ini
[Db]
host="mysql:host=localhost"
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
```
The executable file "**index.php**" should be like this:
```php
<?php
require_once  __DIR__  .  '/vendor/autoload.php';
Vktote\Bot::start('config.ini');
```
## Сontrol panel

For the convenience of creating group profiles, use the control panel.

Use "**localhost**" to log in to the control panel.
Click on the log in button.
The first time you login, a password will be created. You need to remember the password, it will be used to access the control panel.
Go to settings  "**localhost/settings**" and create a new group profile by clicking on the "Create a settings profile" button.

## MySQL

The project uses a mysql database.
Import the database file: `db.sql`.

## Task Scheduler

Use crontab on your server or another task scheduler to get fresh posts without stopping.
 
### Usage example

Open and add a task to the task list: `crontab-e`.

Get fresh entries every minute: `* * * * * php /patch for php file`.

Example of the path to the profile of the "test" group:
```
groups/test/index.php
```

