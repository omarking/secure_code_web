<?php
$message=$_GET['message'];
$message=urlencode($message);
$chatID=$_GET['chatid'];

$telegramURL = "https://api.telegram.org/bot2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc/sendMessage?chat_id=$chatID&text=$message";
$telegramResponseData = file_get_contents($telegramURL);
$responseData = json_decode($telegramResponseData, true);
 var_dump(json_decode($telegramResponseData));

?>