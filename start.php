<?php

$start = microtime(true);
$memory = memory_get_usage();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php';

$groupPath = __DIR__ . '/' . PATH_GROUP_FOLDER . '/';

if (isset($argv[1])) {
	$groupPath .= $argv[1];
	if (file_exists($groupPath)) {
		Vktote\Bot::start($groupPath . '/' . GROUP_CONFIG);

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
	} else {
		echo 'Config folder not found';
	}

} else {
	echo 'The argument(Group name) is not set';
}