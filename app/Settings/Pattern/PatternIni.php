<?php 
return '[Db]
host="'.$_POST['host'].'"
dbName="'.$_POST['dbName'].'"
user="'.$_POST['user'].'"
pass="'.$_POST['pass'].'"
[Vk]
token="'.$_POST['token'].'"
idGroup="'.$_POST['idGroup'].'"
count="'.$_POST['count'].'"
[Telegram]
botApiKey="'.$_POST['botApiKey'].'"
botName="'.$_POST['botName'].'"
chatId="'.$_POST['chatId'].'"';


// function validations(string $name){
//     if($ret = preg_match_all('/<[A-Za-zА-Яа-я]{1,}>|[<]{1}[>]{1}/g',$_POST[$name])){
//         return $ret;
//     }else{
//         die("The data '{$name}' in the configuration file contains: tags or Cyrillic");
//     }
// }
// return '[Db]
// host="'.validations('host').'"
// dbName="'.validations('dbName').'"
// user="'.validations('user').'"
// pass="'.validations('pass').'"
// [Vk]
// token ="'.validations('token').'"
// idGroup="'.validations('idGroup').'"
// count="'.validations('count').'"
// [Telegram]
// botApiKey="'.validations('botApiKey').'"
// botName="'.validations('botName').'"
// chatId="'.validations('chatId').'"';