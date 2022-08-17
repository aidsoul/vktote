<?php

$start = microtime(true);
$memory = memory_get_usage();

$path = __DIR__ . '/../';
require_once $path . 'vendor/autoload.php';
require_once $path . 'config.php';
Vktote\Bot::start(__DIR__ . '/' . $argv[1] . '/' . GROUP_CONFIG);

$memory = memory_get_usage() - $memory;
$time = microtime(true) - $start;

$i = 0;
while (floor($memory / 1024) > 0) {
	$i++;
	$memory /= 1024;
}

$name = ['байт', 'КБ', 'МБ'];
$memory = round($memory, 2) . ' ' . $name[$i];

echo $time . ' сек. / ' . $memory;
