<a  href="https://github.com/aidsoul/vktote/releases/latest"  title="GitHub release">
<img  src="https://img.shields.io/github/v/release/aidsoul/vktote">
</a>

# vktote

This is auto-posting from a VK group to a telegram channel.
  
## Installation
  
You need:
 - apache2;
 - php 8.1;
 - MySQL.

To install, use the command: `git clone https://github.com/aidsoul/vktote`.
Download the necessary libraries using the command: `composer install`.

Or use command `composer create-project aidsoul/vktote`.

## Connection example
**All files for working with groups are located in the "groups" folder.**

> In the "groups" folder, folder with the files listed below are added. All these files are needed for work. Come up with a name for the folder yourself. 

The following example is a true profile group creation:
```
groups
[test]=>[config.ini]
[test1]=>[config.ini]
[test...]=>[config.ini]
```
>If necessary, you can change the folder and the name of the files in the configuration file "**config.php**".

Configuration file "**config.ini** " should look like this:
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

Get fresh entries every minute: `* * * * * php groups/start.php group_folder`.

Below is an example of running a task for the "test" group profile. Test is specified as an argument.
```
*/5 * * * * php groups/start.php test
```
### API
All API queries start with https://domain/api/
#### bot.start
Accepts a GET request with the parameter "group".

Example: https://domain/api/bot.start?group=group_name