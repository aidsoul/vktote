<?php
$path = __DIR__.'/../';
require_once $path.'vendor/autoload.php';
require_once $path.'config.php';
Vktote\Bot::start(__DIR__.'/'.$argv[1].'/config.ini');