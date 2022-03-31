  <a href="https://github.com/aidsoul/vktote/releases/latest" title="GitHub release">
   <img src="https://img.shields.io/github/v/release/aidsoul/vktote">
  </a>

# vktote
>This is auto-posting from a VK group to a telegram channel".

## Installation

To install, use the command: `git clone https://github.com/aidsoul/vktote`.

Download the necessary libraries using the command: `composer install`.

Or use command `composer require aidsoul/vktote`.

## Connection example
```php
require_once __DIR__.'/vendor/autoload.php';
$config =  [
    'Vk'        =>[
   	    'token'         => 'Your token',
   	    'idGroup'       => 'Group id or name',
   	    'count'         => 5
    ],
    'Telegram'  =>[
      	'botApiKey'     => '',
      	'botName'       => '',
     	  'chatId'        =>  0
    ],
    'Db'        =>[
       	'host'          => 'mysql:host=localhost',
       	'dbName'        =>  'vk',
        'user'          =>  'root',
        'pass'          =>  ''
      ],
  ];

Vktote\Bot::start($config);
```

## MySQL

>The project uses a mysql database.

And finally, import the database file: `db.sql`.


## Task Scheduler

>Use crontab on your server or another task scheduler to get fresh posts without stopping.

### Usage example

Open and add a task to the task list: `crontab-e`.
Get fresh entries every minute: `* * * * * php /patch for php file`.
