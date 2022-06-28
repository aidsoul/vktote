<?php 
$server = '$_SERVER'."['DOCUMENT_ROOT']";
return "<?php
require_once {$server} . '/vendor/autoload.php';
Vktote\Bot::start('{$file->iniFile}');
";