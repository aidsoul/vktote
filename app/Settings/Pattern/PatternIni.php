<?php 
function patternVkTel(){
return '[Vk]
token="'.$_POST['token'].'"
idGroup="'.$_POST['idGroup'].'"
count="'.$_POST['count'].'"
[Telegram]
botApiKey="'.$_POST['botApiKey'].'"
botName="'.$_POST['botName'].'"
chatId="'.$_POST['chatId'].'"';
}

$pattern = '';
if(DB_COMMON){
$pattern = patternVkTel();
}else{
$pattern = '[Db]
host="'.$_POST['host'].'"
dbName="mysql:host='.$_POST['dbName'].'"
user="'.$_POST['user'].'"
pass="'.$_POST['pass'].'"'."\r\n".patternVkTel();
}

return $pattern;